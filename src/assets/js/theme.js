// document.addEventListener('DOMContentLoaded', () => {
// const toggleSwitch = document.getElementById('theme-toggle');
// const html = document.documentElement;
// const logo = document.getElementById('logo');

// // Kiểm tra theme đã lưu trong localStorage
// const savedTheme = localStorage.getItem('theme') || 'dark-theme';
// html.classList.add(savedTheme);
// toggleSwitch.checked = savedTheme === 'light-theme';

// // Cập nhật logo dựa trên theme
// logo.src = savedTheme === 'light-theme' ? logo.dataset.lightSrc : logo.dataset.darkSrc;

// // Xử lý sự kiện thay đổi switch
// toggleSwitch.addEventListener('change', () => {
//     if (toggleSwitch.checked) {
//     html.classList.remove('dark-theme');
//     html.classList.add('light-theme');
//     localStorage.setItem('theme', 'light-theme');
//     logo.src = logo.dataset.lightSrc; // Logo cho light theme
//     } else {
//     html.classList.remove('light-theme');
//     html.classList.add('dark-theme');
//     localStorage.setItem('theme', 'dark-theme');
//     logo.src = logo.dataset.darkSrc; // Logo cho dark theme
//     }
// });
// });
