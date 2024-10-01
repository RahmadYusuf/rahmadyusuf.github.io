const jobTableBody = document.getElementById("jobTableBody");
const jobTableContainer = document.getElementById("jobTableContainer");

const jobs = [
{ posisi: "Web Developer", perusahaan: "PT. Teknologi Indonesia", lokasi: "Samarinda", tanggalBerakhir: "31-12-2023" },
{ posisi: "Data Scientist", perusahaan: "PT. Analisis Data", lokasi: "Balikpapan", tanggalBerakhir: "15-01-2024" },
{ posisi: "Desainer Grafis", perusahaan: "PT. Kreatif Digital", lokasi: "Bontang", tanggalBerakhir: "28-02-2024" },
{ posisi: "Software Engineer", perusahaan: "PT. Solusi Teknologi", lokasi: "Jakarta", tanggalBerakhir: "10-11-2024" },
{ posisi: "Mobile Developer", perusahaan: "PT. Aplikasi Digital", lokasi: "Surabaya", tanggalBerakhir: "05-05-2024" },
{ posisi: "Backend Developer", perusahaan: "PT. Data Inovasi", lokasi: "Bandung", tanggalBerakhir: "20-03-2024" },
{ posisi: "Frontend Developer", perusahaan: "PT. Kreatif Karya", lokasi: "Makassar", tanggalBerakhir: "12-07-2024" },
{ posisi: "UI/UX Designer", perusahaan: "PT. Desain Interaktif", lokasi: "Medan", tanggalBerakhir: "18-08-2024" },
{ posisi: "DevOps Engineer", perusahaan: "PT. Infrastruktur Digital", lokasi: "Yogyakarta", tanggalBerakhir: "30-09-2024" },
{ posisi: "Product Manager", perusahaan: "PT. Manajemen Produk", lokasi: "Jakarta", tanggalBerakhir: "25-10-2024" },
{ posisi: "Data Analyst", perusahaan: "PT. Analisis Data", lokasi: "Balikpapan", tanggalBerakhir: "15-01-2024" },
{ posisi: "Digital Marketing", perusahaan: "PT. Pemasaran Digital", lokasi: "Samarinda", tanggalBerakhir: "22-11-2024" },
{ posisi: "Business Analyst", perusahaan: "PT. Konsultasi Bisnis", lokasi: "Bandung", tanggalBerakhir: "19-02-2024" },
{ posisi: "Quality Assurance", perusahaan: "PT. Jaminan Kualitas", lokasi: "Surabaya", tanggalBerakhir: "01-04-2024" },
{ posisi: "Network Engineer", perusahaan: "PT. Jaringan Teknologi", lokasi: "Jakarta", tanggalBerakhir: "16-06-2024" },
{ posisi: "System Administrator", perusahaan: "PT. Administrasi Sistem", lokasi: "Medan", tanggalBerakhir: "15-12-2024" },
{ posisi: "Cloud Engineer", perusahaan: "PT. Layanan Awan", lokasi: "Bontang", tanggalBerakhir: "27-01-2025" },
{ posisi: "Security Analyst", perusahaan: "PT. Keamanan Cyber", lokasi: "Yogyakarta", tanggalBerakhir: "11-03-2025" },
{ posisi: "Sales Executive", perusahaan: "PT. Penjualan Terbaik", lokasi: "Makassar", tanggalBerakhir: "03-05-2025" },
{ posisi: "Content Writer", perusahaan: "PT. Penulisan Kreatif", lokasi: "Jakarta", tanggalBerakhir: "08-08-2025" },
{ posisi: "Graphic Designer", perusahaan: "PT. Desain Grafis", lokasi: "Bali", tanggalBerakhir: "25-09-2025" }
];


// Fungsi untuk melakukan pencarian pekerjaan
document.querySelector(".job-search-form").addEventListener("submit", function(event) {
event.preventDefault();

const jobTitle = document.getElementById("job-title").value.toLowerCase();
const location = document.getElementById("lokasi").value.toLowerCase();

// Kosongkan tabel sebelumnya
jobTableBody.innerHTML = "";

// Filter pekerjaan berdasarkan input
const filteredJobs = jobs.filter(job => {
  return (job.posisi.toLowerCase().includes(jobTitle) || jobTitle === "") &&
         (job.lokasi.toLowerCase().includes(location) || location === "");
});

// Menampilkan hasil pencarian
if (filteredJobs.length > 0) {
  filteredJobs.forEach((job, index) => {
      const row = document.createElement("tr");
      row.className = "table-kerja-row";
      row.innerHTML = `
          <td class="table-kerja-data">${index + 1}</td>
          <td class="table-kerja-data">${job.posisi}</td>
          <td class="table-kerja-data">${job.perusahaan}</td>
          <td class="table-kerja-data">${job.lokasi}</td>
          <td class="table-kerja-data">${job.tanggalBerakhir}</td>
      `;
      jobTableBody.appendChild(row);
  });
  jobTableContainer.style.display = "block"; // Tampilkan tabel
} else {
  jobTableContainer.style.display = "none"; // Sembunyikan tabel jika tidak ada hasil
  alert("Pekerjaan tidak ditemukan.");
}
});

//Dark Mode
var btn = document.getElementById("btn");
var light = document.getElementById("light");
var body = document.body;

function toggleBtn() {
    btn.classList.toggle("active");
    light.classList.toggle("on");
    body.classList.toggle("dark-mode");
  }

//Hamburger
const hamburger = document.getElementById('hamburger');
const navbarList = document.getElementById('navbar-list');

hamburger.addEventListener('click', () => {
    navbarList.style.display = navbarList.style.display === 'flex'? 'none' : 'flex';
});
