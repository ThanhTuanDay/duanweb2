// Toggle password visibility
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
    input.setAttribute('type', type);
}

// Preview avatar image
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const profileAvatar = document.querySelector('.profile-avatar img');
            profileAvatar.src = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// Check password strength
function checkPasswordStrength() {
    const password = document.getElementById('new-password').value;
    const meter = document.getElementById('password-strength-meter');
    const text = document.getElementById('password-strength-text');

    // Remove all classes
    meter.classList.remove('weak', 'medium', 'strong');

    if (password.length === 0) {
        meter.style.width = '0';
        text.textContent = 'Password strength';
        return;
    }

    // Check password strength
    let strength = 0;

    // If password length is >= 8
    if (password.length >= 8) strength += 1;

    // If password contains lowercase and uppercase characters
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1;

    // If password contains numbers and special characters
    if (password.match(/([0-9])/)) strength += 1;
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;

    // Update meter and text based on strength
    if (strength <= 2) {
        meter.classList.add('weak');
        text.textContent = 'Weak';
    } else if (strength === 3) {
        meter.classList.add('medium');
        text.textContent = 'Medium';
    } else {
        meter.classList.add('strong');
        text.textContent = 'Strong';
    }
}

// Save personal information
function savePersonalInfo() {
    // Validate personal information form
    const userId = document.getElementById('user-id').value;
    const firstName = document.getElementById('first-name').value.trim();
    const lastName = document.getElementById('last-name').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const address = document.getElementById('address').value.trim();
    const email = document.getElementById('email').value.trim();
    document.getElementById('first-name-error').style.display = 'none';
    document.getElementById('last-name-error').style.display = 'none';
    document.getElementById('phone-error').style.display = 'none';

    let isValid = true;

    if (firstName === '') {
        document.getElementById('first-name-error').style.display = 'block';
        isValid = false;
    }
    if (lastName === '') {
        document.getElementById('last-name-error').style.display = 'block';
        isValid = false;
    }
    if (phone === '' || !isValidPhone(phone)) {
        document.getElementById('phone-error').style.display = 'block';
        isValid = false;
    }

    if (isValid) {
        fetch('http://localhost/duanweb2/update-user-info', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ userId, email, firstName, lastName, phone, address })
        })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    const successMessage = document.getElementById('personal-info-success');
                    successMessage.classList.add('show');
                    setTimeout(() => successMessage.classList.remove('show'), 3000);
                    document.querySelector('.profile-name').textContent = `${firstName} ${lastName}`;
                }
            }).catch(error => {
                console.error('Fetch error:', error);
            });
    }
}

// Change password
function changePassword() {
    const userId = document.getElementById('user-id').value;
    const currentPassword = document.getElementById('current-password').value;
    const newPassword = document.getElementById('new-password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    document.getElementById('current-password-error').style.display = 'none';
    document.getElementById('new-password-error').style.display = 'none';
    document.getElementById('confirm-password-error').style.display = 'none';

    let isValid = true;

    if (currentPassword === '') {
        document.getElementById('current-password-error').style.display = 'block';
        isValid = false;
    }
    if (newPassword === '' || newPassword.length < 8) {
        document.getElementById('new-password-error').style.display = 'block';
        isValid = false;
    }
    if (newPassword !== confirmPassword) {
        document.getElementById('confirm-password-error').style.display = 'block';
        isValid = false;
    }

    if (isValid) {
        fetch('http://localhost/duanweb2/change-password', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ userId, currentPassword, newPassword })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const successMessage = document.getElementById('password-success');
                    successMessage.classList.add('show');
                    setTimeout(() => successMessage.classList.remove('show'), 3000);
                    resetPasswordForm();
                } else {
                    document.getElementById('current-password-error').textContent = 'Mật khẩu cũ không đúng';
                    document.getElementById('current-password-error').style.display = 'block';
                }
            });
    }
}

// Reset personal information form
function resetPersonalInfoForm() {
    
}

// Reset password form
function resetPasswordForm() {
    document.getElementById('current-password').value = '';
    document.getElementById('new-password').value = '';
    document.getElementById('confirm-password').value = '';
    checkPasswordStrength();
}



// Menu item click handler
document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', function (e) {
        // Remove active class from all menu items
        document.querySelectorAll('.menu-item').forEach(i => {
            i.classList.remove('active');
        });

        // Add active class to clicked menu item
        this.classList.add('active');

        // If the link is to an anchor on the same page
        const href = this.getAttribute('href');
        if (href.startsWith('#')) {
            e.preventDefault();

            // Scroll to the section
            const section = document.querySelector(href);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
});