document.addEventListener('DOMContentLoaded', function() {
    // Para rastrear los campos más facilmente
    let touchedFields = {
        // USUARIOS
        name: false,
        surname: false,
        birthDate: false,
        sex: false,
        email: false,
        password: false,
        confirmPassword: false,
        phone: false,
        country: false,
        autonomousCommunity: false,
        province: false,
        postalCode: false

    };

    // RANGO DE CÓDIGOS POSTALES VÁLIDOS PARA CADA PROVINCIA
    const postalCodeRanges = {
        "1": [/^04\d{3}$/], // Almería
        "2": [/^11\d{3}$/], // Cádiz
        "3": [/^14\d{3}$/], // Córdoba
        "4": [/^18\d{3}$/], // Granada
        "5": [/^21\d{3}$/], // Huelva
        "6": [/^23\d{3}$/], // Jaén
        "7": [/^29\d{3}$/], // Málaga
        "8": [/^41\d{3}$/], // Sevilla
        "9": [/^08\d{3}$/], // Barcelona
        "10": [/^17\d{3}$/], // Girona
        "11": [/^25\d{3}$/], // Lleida
        "12": [/^43\d{3}$/], // Tarragona
        "13": [/^28\d{3}$/], // Madrid
        "14": [/^03\d{3}$/], // Alicante
        "15": [/^12\d{3}$/], // Castellón
        "16": [/^46\d{3}$/], // Valencia
        "17": [/^15\d{3}$/], // A Coruña
        "18": [/^27\d{3}$/], // Lugo
        "19": [/^32\d{3}$/], // Ourense
        "20": [/^36\d{3}$/], // Pontevedra
        "21": [/^01\d{3}$/], // Álava
        "22": [/^20\d{3}$/], // Guipúzcoa
        "23": [/^48\d{3}$/], // Vizcaya
        "24": [/^05\d{3}$/], // Ávila
        "25": [/^09\d{3}$/], // Burgos
        "26": [/^24\d{3}$/], // León
        "27": [/^34\d{3}$/], // Palencia
        "28": [/^37\d{3}$/], // Salamanca
        "29": [/^40\d{3}$/], // Segovia
        "30": [/^42\d{3}$/], // Soria
        "31": [/^47\d{3}$/], // Valladolid
        "32": [/^49\d{3}$/], // Zamora
        "33": [/^02\d{3}$/], // Albacete
        "34": [/^13\d{3}$/], // Ciudad Real
        "35": [/^16\d{3}$/], // Cuenca
        "36": [/^19\d{3}$/], // Guadalajara
        "37": [/^45\d{3}$/], // Toledo
        "38": [/^35\d{3}$/], // Las Palmas
        "39": [/^38\d{3}$/], // Santa Cruz de Tenerife
        "40": [/^22\d{3}$/], // Huesca
        "41": [/^44\d{3}$/], // Teruel
        "42": [/^50\d{3}$/], // Zaragoza
        "43": [/^06\d{3}$/], // Badajoz
        "44": [/^10\d{3}$/], // Cáceres
        "45": [/^33\d{3}$/], // Asturias
        "46": [/^39\d{3}$/], // Cantabria
        "47": [/^07\d{3}$/], // Islas Baleares
        "48": [/^26\d{3}$/], // La Rioja
        "49": [/^30\d{3}$/], // Murcia
        "50": [/^31\d{3}$/], // Navarra
        "51": [/^51\d{3}$/], // Ceuta
        "52": [/^52\d{3}$/]  // Melilla
    };
    // Hacemos una funcion por cada validador para que se muestre más limpio el código

    // NOMBRE -> Validamos que solo haya letras y espacios, con un mínimo de 3 caracteres.
    function validateName() {
        const name = document.getElementById('name').value;
        const nameError = document.getElementById('nameError');
        const namePattern = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/;

        if (touchedFields.name) {
            if (!namePattern.test(name)) {
                nameError.textContent = 'El nombre solo puede contener letras y espacios.';
                return false;
            } else if (name.length < 3) {
                nameError.textContent = 'El nombre debe tener al menos 3 caracteres.';
                return false;
            } else {
                nameError.textContent = '';
            }
        }
        return true;
    }

    // APELLIDOS -> Validamos que solo haya letras y espacios, con un mínimo de 3 caracteres
    function validateSurname() {
        const surname = document.getElementById('surname').value;
        const surnameError = document.getElementById('surnameError');
        const surnamePattern = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/;

        if (touchedFields.surname) {
            if (!surnamePattern.test(surname)) {
                surnameError.textContent = 'Los apellidos solo pueden contener letras y espacios.';
                return false;
            } else if (surname.length < 3) {
                surnameError.textContent = 'Los apellidos deben tener al menos 3 caracteres.';
                return false;
            } else {
                surnameError.textContent = '';
            }
        }
        return true;
    }

    // FECHA DE NACIMIENTO (El cual tiene que ser mayor de edad)
    function validateBirthDate() {
        const birthDate = document.getElementById('birthDate').value;
        const birthDateError = document.getElementById('birthDateError');

        if (touchedFields.birthDate) {
            if (!isAdult(birthDate)) {
                birthDateError.textContent = 'Debes ser mayor de edad para registrarte.';
                return false;
            } else {
                birthDateError.textContent = '';
            }
        }
        return true;
    }

    // GENERO -> Validamos que el usuario seleccione una opción
    function validateSex() {
        const sex = document.getElementById('sex').value;
        const sexError = document.getElementById('sexError');

        if (touchedFields.sex) {
            if (sex === '') {
                sexError.textContent = 'Selecciona tu género.';
                return false;
            } else {
                sexError.textContent = '';
            }
        }
        return true;
    }

    // EMAIL -> Validamos que este en el formato correcto
    function validateEmail() {
        const email = document.getElementById('email').value;
        const emailError = document.getElementById('emailError');
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        if (touchedFields.email) {
            if (!emailPattern.test(email)) {
                emailError.textContent = 'Ingresa un email válido.';
                return false;
            } else {
                // Verificar si el correo ya está en uso
                checkEmailAvailability(email, emailError);
                emailError.textContent = ''; // Limpiar el error si el formato es válido
            }
        }
        return true;
    }

    function checkEmailAvailability(email, emailErrorElement) {
        fetch('/check-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                emailErrorElement.textContent = 'Este correo ya está en uso.';
            } else {
                emailErrorElement.textContent = '';
            }
        })
        .catch(error => {
            console.error('Error al verificar el correo:', error);
        });
    }


    // CONTRASEÑA -> Validamos que tenga un mínimo de caracteres (6) y un carácter especial (al menos)
    function validatePassword() {
        const password = document.getElementById('password').value;
        const passwordError = document.getElementById('passwordError');
        const passwordPattern = /^(?=.*[!@#$%^&*.,-])[A-Za-z\d!@#$%^&*.,-]{6,}$/;

        if (touchedFields.password) {
            if (!passwordPattern.test(password)) {
                passwordError.textContent = 'La contraseña debe tener al menos 6 caracteres y un carácter especial.';
                return false;
            } else {
                passwordError.textContent = '';
            }
        }
        return true;
    }

    // CONFIRMAR CONTRASEÑA (Que sea igual a Contraseña)
    function validateConfirmPassword() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const confirmPasswordError = document.getElementById('confirmPasswordError');

        if (touchedFields.confirmPassword) {
            if (confirmPassword !== password) {
                confirmPasswordError.textContent = 'Las contraseñas no coinciden.';
                return false;
            } else {
                confirmPasswordError.textContent = '';
            }
        }
        return true;
    }

    // TELEFONO -> Validamos que sean solos dígitos (tiene que ser 9)
    function validatePhone() {
        const phone = document.getElementById('phone').value;
        const phoneError = document.getElementById('phoneError');
        const phonePattern = /^(?:(?:\+34|0034)\s?)?(6|7|8|9)\d{8}$/;

        if (touchedFields.phone) {
            if (phone === '') {
                phoneError.textContent = 'El número de teléfono es obligatorio.';
                return false;
            } else if (!phonePattern.test(phone)) {
                if (!/^\d+$/.test(phone.replace(/\s+/g, ''))) {
                    phoneError.textContent = 'El número de teléfono solo puede contener dígitos.';
                } else if (phone.length !== 9 && !phone.startsWith('+34')) {
                    phoneError.textContent = 'El número de teléfono debe tener 9 dígitos si no incluye el +34.';
                } else {
                    phoneError.textContent = 'El número debe comenzar con 6, 7, 8 o 9.';
                }
                return false;
            } else {
                phoneError.textContent = '';
            }
        }
        return true;
    }

    // PAIS -> Validamos que el usuario seleccione una opción
    function validateCountry() {
        const country = document.getElementById('country').value;
        const countryError = document.getElementById('countryError');

        if (touchedFields.country) {
            if (country === '') {
                countryError.textContent = 'Selecciona un país.';
                return false;
            } else {
                countryError.textContent = '';
            }
        }
        return true;
    }

    // COMUNIDAD AUTÓNOMA -> Validamos que el usuario seleccione una opción
    function validateAutonomousCommunity() {
        const autonomousCommunity = document.getElementById('autonomousCommunity').value;
        const autonomousCommunityError = document.getElementById('autonomousCommunityError');

        if (touchedFields.autonomousCommunity) {
            if (autonomousCommunity === '') {
                autonomousCommunityError.textContent = 'Selecciona una comunidad autónoma.';
                return false;
            } else {
                autonomousCommunityError.textContent = '';
            }
        }
        return true;
    }

    // PROVINCIA -> Validamos que el usuario seleccione una opción
    function validateProvince() {
        const province = document.getElementById('province').value;
        const provinceError = document.getElementById('provinceError');

        if (touchedFields.province) {
            if (province === '') {
                provinceError.textContent = 'Selecciona una provincia.';
                return false;
            } else {
                provinceError.textContent = '';
            }
        }
        return true;
    }

    // CÓDIGO POSTAL -> Validamos que coincida con el formato y la provincia seleccionada
    function validatePostalCode() {
        const postalCodeField = document.getElementById('postalCode');
        const postalCodeError = document.getElementById('postalCodeError');
        const postalCode = postalCodeField.value;
        const province = document.getElementById('province').value;

        // console.log(`Validando código postal: ${postalCode} con provincia: ${province}`);

        // Solo valida si el campo está habilitado y el usuario ha empezado a escribir
        if (touchedFields.postalCode && postalCodeField.disabled === false) {
            // Verificar si el campo está vacío
            if (postalCode === '') {
                postalCodeError.textContent = 'El código postal es obligatorio.';
                return false;
            }

            // Verificar si el código postal contiene solo caracteres numéricos
            if (!/^\d+$/.test(postalCode)) {
                postalCodeError.textContent = 'El código postal solo debe contener números.';
                return false;
            }

            // Validar el rango del código postal en relación con la provincia seleccionada
            if (province && postalCodeRanges[province]) {
                // console.log(`Provincia encontrada en postalCodeRanges. Patrón(es):`, postalCodeRanges[province]);
                const isValidPostalCode = postalCodeRanges[province].some(pattern => pattern.test(postalCode));
                if (!isValidPostalCode) {
                    postalCodeError.textContent = 'El código postal no corresponde a la provincia seleccionada.';
                    return false;
                } else {
                    postalCodeError.textContent = '';
                }
            } else {
                // console.log('Provincia no encontrada en postalCodeRanges o inválida:', province);
                postalCodeError.textContent = 'Selecciona una provincia válida.';
                return false;
            }
        }
        return true;
    }

    // COMPROBACIÓN SI ES MAYOR DE EDAD
    function isAdult(dateString) {
        const birthDate = new Date(dateString);
        const today = new Date();
        const age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        const dayDiff = today.getDate() - birthDate.getDate();

        return (age > 18) || (age === 18 && monthDiff > 0) || (age === 18 && monthDiff === 0 && dayDiff >= 0);
    }

    // Ejecutamos todas las funciones de validación y devuelve si el formato es válido
    function validateForm() {
        let isValid = true;
        isValid = validateName() && isValid;
        isValid = validateSurname() && isValid;
        isValid = validateBirthDate() && isValid;
        isValid = validateSex() && isValid;
        isValid = validateEmail() && isValid;
        isValid = validatePassword() && isValid;
        isValid = validateConfirmPassword() && isValid;
        isValid = validatePhone() && isValid;
        isValid = validateCountry() && isValid;
        isValid = validateAutonomousCommunity() && isValid;
        isValid = validateProvince() && isValid;
        isValid = validatePostalCode() && isValid;
        return isValid;
    }


    // Configuramos los eventos de validación en tiempo real para cada campo, se utiliza input para cuando se escribe y change cuando se selecciona
    document.getElementById('name').addEventListener('input', () => { touchedFields.name = true; validateForm(); });
    document.getElementById('surname').addEventListener('input', () => { touchedFields.surname = true; validateForm(); });
    document.getElementById('birthDate').addEventListener('input', () => { touchedFields.birthDate = true; validateForm(); });
    document.getElementById('sex').addEventListener('change', () => { touchedFields.sex = true; validateForm(); });
    document.getElementById('email').addEventListener('input', () => { touchedFields.email = true; validateEmail(); });
    document.getElementById('password').addEventListener('input', () => { touchedFields.password = true; validateForm(); });
    document.getElementById('confirmPassword').addEventListener('input', () => { touchedFields.confirmPassword = true; validateForm(); });
    document.getElementById('phone').addEventListener('input', () => { touchedFields.phone = true; validateForm(); });
    document.getElementById('country').addEventListener('change', () => { touchedFields.country = true; validateForm(); });
    document.getElementById('autonomousCommunity').addEventListener('change', () => { touchedFields.autonomousCommunity = true; validateForm(); });
    document.getElementById('province').addEventListener('change', () => { touchedFields.province = true; validateForm(); });
    document.getElementById('postalCode').addEventListener('input', () => { touchedFields.postalCode = true; validatePostalCode(); });


    // Asignamos la función de validación al evento de envío del formulario
    document.getElementById('registerForm').onsubmit = function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Evitamos el envío si la validación falla, no se haría el registro.
        }
    };
});
