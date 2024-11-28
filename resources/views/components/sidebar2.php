#snackbar {
        display: none; /* Hide by default */
        position: fixed;
        top: 50px;
        left: 0;
        width: 100%;
        background-color: #fff; /* Background putih */
        color: #333;
        z-index: 1000;
        padding: 16px 0;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, opacity 0.3s ease;
        transform: translateY(-100%);
        opacity: 0;
        border-top: 1px solid #e5e7eb; /* Border atas */
    }

    #snackbar.show {
        display: block;
        transform: translateY(0);
        opacity: 1;
    }

    #snackbar .dropdown-content {
        max-width: 90%;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(6, 1fr); /* Sesuaikan jumlah kolom */
        gap: 20px; /* Jarak antar kolom */
        padding: 20px 0;
    }

    #snackbar .dropdown-content h3 {
        font-size: 16px;
        font-weight: 600;
        color: #E01535;
        margin-bottom: 10px;
    }

    #snackbar .dropdown-content ul {
        list-style-type: none;
        padding: 0;
    }

    #snackbar .dropdown-content ul li {
        font-size: 14px;
        color: #333;
        margin-bottom: 5px;
    }
