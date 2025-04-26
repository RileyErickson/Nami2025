<footer class="footer">
    <div class="left">
        <img src="images/whitenamilogo.png" alt="nami" class="main-image" style="width: 15%;">
        <div class="image-links">
            <a href="https://www.instagram.com/namirappahannock">Instagram</a>
            <a href="https://www.facebook.com/NAMIrapp.org/">Facebook</a>
            <a href="https://linktr.ee/namirapp">LinkTree</a>
        </div>
    </div>
    <div class="right">
        <div class="contact-info">
            <div>Contact us here: <br> info@namirapp.org</div>
            <div><a href="bugreport.php" class="bug-link">Report a bug</a></div>
        </div>
    </div>
</footer>
<style>

.footer {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    background-color: #0c499c;
    padding: 20px 40px;
    font-size: 16px;
    color: #fff;
    flex-shrink: 0;
    margin-top: auto;
}

.footer .left {
    display: flex;
    align-items: center;
    gap: 20px; 
}

.footer .image-links {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.footer .image-links a {
    color: white;
}

.footer .image-links a:hover {
    font-weight: bold;
    animation: bounce 0.5s ease;
    filter: brightness(0) saturate(100%) invert(50%) sepia(100%) saturate(700%) hue-rotate(40deg);
}

.footer .right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: center;
}

.footer .contact-info {
    text-align: right;
    font-size: 18px;
}

.footer .bug-link {
    text-decoration: none;
    color: white;
    font-size: 18px;
}

.footer .bug-link:hover {
    font-weight: bold;
    animation: bounce 0.5s ease;
    filter: brightness(0) saturate(100%) invert(50%) sepia(100%) saturate(700%) hue-rotate(40deg);
}

.footer .main-image {
    max-width: 100%;
    height: auto;
}

@media (max-width: 768px) {
  .footer {
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 30px 20px;
  }

  .footer .left {
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding-bottom: 20px;
  }

  .footer .image-links {
    align-items: center;
  }

  .footer .main-image {
    width: 200px !important; /* Force the image to be larger */
    height: auto !important; /* Ensure aspect ratio is preserved */
  }

  .footer .right {
    align-items: center;
    justify-content: center;
    text-align: center;
  }

  .footer .contact-info {
    text-align: center;
  }
}

@keyframes bounce {
    0% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
    100% {
        transform: translateY(0);
    }
}
