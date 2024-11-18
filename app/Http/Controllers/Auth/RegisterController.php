<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ComunidadAutonoma;
use App\Models\Genero;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }



    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        // Obtener los datos de País, Provincia y Comunidad Autónoma desde la base de datos
        $paises = Pais::all();
        $provincias = Provincia::all();
        $comunidades = ComunidadAutonoma::all();
        $generos = Genero::all();

        // Pasar los datos a la vista
        return view('auth.register', compact('generos', 'paises', 'provincias', 'comunidades' ));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|min:3|max:255|regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/',
            'surname' => 'required|string|min:3|max:255|regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/',
            'birthDate' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $birthDate = new \DateTime($value);
                    $today = new \DateTime();
                    $age = $today->diff($birthDate)->y;

                    if ($age < 18) {
                        $fail('Debes ser mayor de edad para registrarte.');
                    }
                },
            ],
            'sex' => 'required',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/^(?=.*[!@#$%^&*.,-])[A-Za-z\d!@#$%^&*.,-]+$/',
                'confirmed',
            ],
            'phone' => [
                'required',
                'regex:/^(?:(?:\+34|0034)\s?)?(6|7|8|9)\d{8}$/',
                'max:20'
            ],
            'country' => 'required',
            'autonomousCommunity' => 'required',
            'postalCode' => [
                'required',
                'string',
                'max:10',
                function ($attribute, $value, $fail) use ($data) {
                    $valid = $this->validatePostalCode($value, $data['province']);
                    if (!$valid) {
                        $fail('El código postal no coincide con la provincia seleccionada.');
                    }
                },
            ],
        ]);
    }

       // Función personalizada para validar el código postal según la provincia
       protected function validatePostalCode($postalCode, $provinceId)
       {

        error_log("Código postal recibido: $postalCode, Provincia ID: $provinceId");

           // Rango de códigos postales por provincia
           $postalCodeRanges = [
               "1" => '/^04\d{3}$/', // Almería
               "2" => '/^11\d{3}$/', // Cádiz
               "3" => '/^14\d{3}$/', // Córdoba
               "4" => '/^18\d{3}$/', // Granada
               "5" => '/^21\d{3}$/', // Huelva
               "6" => '/^23\d{3}$/', // Jaén
               "7" => '/^29\d{3}$/', // Málaga
               "8" => '/^41\d{3}$/', // Sevilla
               "9" => '/^08\d{3}$/', // Barcelona
               "10" => '/^17\d{3}$/', // Girona
               "11" => '/^25\d{3}$/', // Lleida
               "12" => '/^43\d{3}$/', // Tarragona
               "13" => '/^28\d{3}$/', // Madrid
               "14" => '/^03\d{3}$/', // Alicante
               "15" => '/^12\d{3}$/', // Castellón
               "16" => '/^46\d{3}$/', // Valencia
               "17" => '/^15\d{3}$/', // A Coruña
               "18" => '/^27\d{3}$/', // Lugo
               "19" => '/^32\d{3}$/', // Ourense
               "20" => '/^36\d{3}$/', // Pontevedra
               "21" => '/^01\d{3}$/', // Álava
               "22" => '/^20\d{3}$/', // Guipúzcoa
               "23" => '/^48\d{3}$/', // Vizcaya
               "24" => '/^05\d{3}$/', // Ávila
               "25" => '/^09\d{3}$/', // Burgos
               "26" => '/^24\d{3}$/', // León
               "27" => '/^34\d{3}$/', // Palencia
               "28" => '/^37\d{3}$/', // Salamanca
               "29" => '/^40\d{3}$/', // Segovia
               "30" => '/^42\d{3}$/', // Soria
               "31" => '/^47\d{3}$/', // Valladolid
               "32" => '/^49\d{3}$/', // Zamora
               "33" => '/^02\d{3}$/', // Albacete
               "34" => '/^13\d{3}$/', // Ciudad Real
               "35" => '/^16\d{3}$/', // Cuenca
               "36" => '/^19\d{3}$/', // Guadalajara
               "37" => '/^45\d{3}$/', // Toledo
               "38" => '/^35\d{3}$/', // Las Palmas
               "39" => '/^38\d{3}$/', // Santa Cruz de Tenerife
               "40" => '/^22\d{3}$/', // Huesca
               "41" => '/^44\d{3}$/', // Teruel
               "42" => '/^50\d{3}$/', // Zaragoza
               "43" => '/^06\d{3}$/', // Badajoz
               "44" => '/^10\d{3}$/', // Cáceres
               "45" => '/^33\d{3}$/', // Asturias
               "46" => '/^39\d{3}$/', // Cantabria
               "47" => '/^07\d{3}$/', // Islas Baleares
               "48" => '/^26\d{3}$/', // La Rioja
               "49" => '/^30\d{3}$/', // Murcia
               "50" => '/^31\d{3}$/', // Navarra
               "51" => '/^51\d{3}$/', // Ceuta
               "52" => '/^52\d{3}$/', // Melilla
           ];

           // Verificamos si la provincia existe en los rangos y si el código postal coincide con el patrón
            if (isset($postalCodeRanges[$provinceId])) {
                $isValid = preg_match($postalCodeRanges[$provinceId], $postalCode);
                // error_log("Provincia ID: $provinceId, Código Postal: $postalCode, Resultado: " . ($isValid ? "Válido" : "No válido"));
                return $isValid;
            }

            // error_log("Provincia no encontrada en los rangos de código postal.");
            return false; // Retorna falso si la provincia no tiene un rango definido
       }

       public function checkEmail(Request $request)
        {
            $emailExists = Usuario::where('email', $request->input('email'))->exists();
            return response()->json(['exists' => $emailExists]);
        }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return Usuario::create([
            'nombre' => $data['name'],
            'apellidos' => $data['surname'],
            'fecha_nacimiento' => $data['birthDate'],
            'genero_id' => $data['sex'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'numero_telefono' => $data['phone'],
            'pais_id' => $data['country'],
            'comunidad_autonoma_id' => $data['autonomousCommunity'],
            'provincia_id' => $data['province'],
            'codigo_postal' => $data['postalCode'],
            'rol_id' => 2,
            'protectora_id' => null,
        ]);
    }

    public function register(Request $request){
    // dd($request->all());
    // Validar los datos del formulario
    $this->validator($request->all())->validate();

    // Crear el usuario en la base de datos
    $usuario = $this->create($request->all());

    // Autenticar al usuario
    Auth::login($usuario);

    // Redireccionar al usuario a la página de inicio
    return redirect($this->redirectTo);
    }
}
