// theme.js
document.addEventListener('DOMContentLoaded', () => {
  const toggleButton = document.getElementById('theme-toggle');
  const html = document.documentElement;
  const logo = document.getElementById('logo');

  // Kiểm tra theme đã lưu trong localStorage
  const savedTheme = localStorage.getItem('theme') || 'dark-theme';
  html.classList.add(savedTheme);
  toggleButton.textContent = savedTheme === 'light-theme' ? 'Dark Theme' : 'Light Theme';

  // Cập nhật logo dựa trên theme
  if (savedTheme === 'light-theme') {
    logo.src = logo.dataset.lightSrc;
  } else {
    logo.src = logo.dataset.darkSrc;
  }

  // Xử lý sự kiện click nút toggle
  toggleButton.addEventListener('click', () => {
    if (html.classList.contains('light-theme')) {
      html.classList.remove('light-theme');
      html.classList.add('dark-theme');
      toggleButton.textContent = 'Light Theme';
      localStorage.setItem('theme', 'dark-theme');
      logo.src = logo.dataset.darkSrc; // Đổi logo cho dark theme
    } else {
      html.classList.remove('dark-theme');
      html.classList.add('light-theme');
      toggleButton.textContent = 'Dark Theme';
      localStorage.setItem('theme', 'light-theme');
      logo.src = logo.dataset.lightSrc; // Đổi logo cho light theme
    }
  });
});