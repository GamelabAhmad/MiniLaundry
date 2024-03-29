document.addEventListener('DOMContentLoaded', function() {
  const antrianBody = document.getElementById('antrian-body');

  // Contoh data antrian
  let dataAntrian = [
    { id: 1, nama: 'John Doe', tanggal: '2024-03-29', berat: '70 kg', alamat: '123 Jalan Contoh, Kota Contoh' },
    { id: 2, nama: 'Jane Smith', tanggal: '2024-03-30', berat: '65 kg', alamat: '456 Jalan Contoh, Kota Contoh' },
    { id: 3, nama: 'David Johnson', tanggal: '2024-03-31', berat: '80 kg', alamat: '789 Jalan Contoh, Kota Contoh' }
  ];

  // Menampilkan data antrian dalam tabel
  function renderTable() {
    antrianBody.innerHTML = '';

    dataAntrian.forEach(function(data) {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${data.nama}</td>
        <td>${data.tanggal}</td>
        <td>${data.berat}</td>
        <td>${data.alamat}</td>
        <td>
          <button class="btn btn-ubah" data-id="${data.id}">Ubah</button>
          <button class="btn btn-hapus" data-id="${data.id}">Hapus</button>
        </td>
      `;
      antrianBody.appendChild(row);
    });
  }

  // Memanggil fungsi untuk pertama kali
  renderTable();

  // Menambahkan event listener untuk tombol ubah
  document.addEventListener('click', function(event) {
    if (event.target.classList.contains('btn-ubah')) {
      const id = parseInt(event.target.getAttribute('data-id'));
      const data = dataAntrian.find(item => item.id === id);
      if (data) {
        const namaBaru = prompt('Masukkan nama baru:', data.nama);
        if (namaBaru !== null) {
          data.nama = namaBaru;
          renderTable();
        }
      }
    }
  });
  

  // Menambahkan event listener untuk tombol hapus
  document.addEventListener('click', function(event) {
    if (event.target.classList.contains('btn-hapus')) {
      const id = parseInt(event.target.getAttribute('data-id'));
      const index = dataAntrian.findIndex(item => item.id === id);
      if (index !== -1) {
        const konfirmasi = confirm('Anda yakin ingin menghapus data ini?');
        if (konfirmasi) {
          dataAntrian.splice(index, 1);
          renderTable();
        }
      }
    }
  });
});



