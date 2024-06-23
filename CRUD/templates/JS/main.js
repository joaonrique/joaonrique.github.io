function validateForm(formId) {
    const form = document.getElementById(formId);
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    let valid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.remove('valid');
            input.classList.add('invalid');
            valid = false;
        } else {
            input.classList.remove('invalid');
            input.classList.add('valid');
        }
    });

    return valid;
}

document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input[required], textarea[required]');

    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (!this.value.trim()) {
                this.classList.remove('valid');
                this.classList.add('invalid');
            } else {
                this.classList.remove('invalid');
                this.classList.add('valid');
            }
        });

        input.addEventListener('blur', function() {
            if (!this.value.trim()) {
                this.classList.remove('valid');
                this.classList.add('invalid');
            }
        });
    });
});
