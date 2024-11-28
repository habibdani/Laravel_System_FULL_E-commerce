<section name="chatwa">
    <div id="whatsapp-icon">
        <a href="http://web.whatsapp.com/send?phone=6281234567890" id="nomorwa3" target="_blank" rel="noopener noreferrer">
            <img src="http://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" />
        </a>
    </div>
</section>

<style>
    #whatsapp-icon {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        background-color: #25d366;
        border-radius: 50%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 60px;
        height: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    #whatsapp-icon:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
    }

    #whatsapp-icon img {
        width: 40px;
        height: 40px;
    }

</style>
<script>
    document.getElementById('whatsapp-icon').addEventListener('click', function () {
        console.log('WhatsApp Icon Clicked!');
    });

    document.addEventListener('DOMContentLoaded', async function () {
        const API_BASE_URL = 'https://andalprima.hansmade.online'; // Ganti sesuai URL API Anda
      
        const nomorwa3Element = document.getElementById('nomorwa3');

        // Fungsi untuk mengambil data nomor WA dari API
        async function fetchInfoWA() {
            try {
                const response = await fetch(`${API_BASE_URL}/api/info-wa`);
                const data = await response.json();

                if (data.success && data.data) {
                    const waInfo = data.data; // Ambil data WA dari respons

                    // Update teks pada elemen
                
                    // Update link WhatsApp
                    const waLink = `http://web.whatsapp.com/send?phone=62${waInfo.nomorwa.replace(/^0/, '')}`;
                    nomorwa3Element.href = waLink;
                    sessionStorage.setItem('waLink', waLink);
                    sessionStorage.setItem('waNomor', waInfo.nomorwa);
                } else {
                    console.error('Gagal memuat data WA:', data.message);
                    alert('Tidak ada data WA yang tersedia.');
                }
            } catch (error) {
                console.error('Error fetching WA info:', error);
                alert('Terjadi kesalahan saat memuat data WA.');
            }
        }

        // Panggil fungsi untuk memuat data WA
        await fetchInfoWA();
    });
</script>