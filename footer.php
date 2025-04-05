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
            <div>Contact us here: <br> namirappahannock2020@gmail.com</div>
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
