<section name="chatwa">
    <div id="whatsapp-icon">
        <a href="https://web.whatsapp.com/send?phone=6281234567890" target="_blank" rel="noopener noreferrer">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" />
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

</script>