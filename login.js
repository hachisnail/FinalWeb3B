

const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.btnLogin');
const iconClose = document.querySelector('.icon_close');

registerLink.addEventListener('click', ()=> {wrapper.classList.add('active');
});

loginLink.addEventListener('click', ()=> {wrapper.classList.remove('active');
});


btnPopup.addEventListener('click', () => {wrapper.classList.add('active-popup');
});


iconClose.addEventListener('click', ()=> {wrapper.classList.remove('active-popup');
});

function gotohome() {
    window.location.href = "./Home.html";
}

const aboutUsBtn = document.getElementById('aboutUsBtn');
const contactUsBtn = document.getElementById('contactUsBtn');
const aboutUsPopup = document.getElementById('aboutUsPopup');
const contactUsPopup = document.getElementById('contactUsPopup');
const aboutClose = document.querySelector('.about_close');
const contactClose = document.querySelector('.contact_close');
const loginClose = document.querySelector('.login_close');

// Show About Us Popup
aboutUsBtn.addEventListener('click', () => {
    aboutUsPopup.style.display = 'block';
});

// Show Contact Us Popup
contactUsBtn.addEventListener('click', () => {
    contactUsPopup.style.display = 'block';
});

loginClose.addEventListener('click', () => {
    loginClose.style.display = 'block';
});

// Close About Us Popup
aboutClose.addEventListener('click', () => {
    aboutUsPopup.style.display = 'none';
});

// Close Contact Us Popup
contactClose.addEventListener('click', () => {
    contactUsPopup.style.display = 'none';
});


loginClose.addEventListener('click', () => {
    wrapper.style.display = 'none';
});

// Close on Outside Click
window.addEventListener('click', (e) => {
    if (e.target === aboutUsPopup) {
        aboutUsPopup.style.display = 'none';
    }
    if (e.target === contactUsPopup) {
        contactUsPopup.style.display = 'none';
    }
    if (e.target === loginClose) {
        wrapper.style.display = 'none';
    }
});
