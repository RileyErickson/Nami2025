<footer class="footer">
    <div class="footer-container">
        <div class="footer-left">
            <img src="images/whitenamilogo.png" alt="NAMI" class="footer-logo">
            <div class="footer-links">
                <a href="https://www.instagram.com/namirappahannock">Instagram</a>
                <a href="https://www.facebook.com/NAMIrapp.org/">Facebook</a>
                <a href="https://linktr.ee/namirapp">LinkTree</a>
            </div>
        </div>
        <div class="footer-right">
            <div class="contact-info">
                <p>Contact us here: <br> namirappahannock2020@gmail.com</p>
                <a href="bugreport.php" class="bug-link">Report a bug</a>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer {
        background-color: #f4f4f4; /* Match the site's background or use a theme color */
        padding: 20px 40px;
        font-size: 16px;
        color: #333;
        text-align: left;
        border-top: 1px solid #ccc;
        margin-top: 40px;
    }

    .footer-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .footer-left,
    .footer-right {
        flex: 1;
        padding: 10px;
    }

    .footer-logo {
        width: 20%;
        max-width: 100px;
    }

    .footer-links a {
        margin: 5px 10px;
        color: #333;
        text-decoration: none;
    }

    .footer-links a:hover {
        text-decoration: underline;
    }

    .contact-info {
        font-size: 14px;
    }

    .bug-link {
        color: #0c499c;
        text-decoration: none;
    }

    .bug-link:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .footer-container {
            flex-direction: column;
            text-align: center;
        }

        .footer-logo {
            width: 30%;
        }

        .footer-links {
            margin-top: 10px;
        }
    }
</style>
