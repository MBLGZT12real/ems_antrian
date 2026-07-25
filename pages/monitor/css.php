<style>
    body {
        overflow: hidden;
        font-family: Arial, Helvetica, sans-serif;
    }

    .card-blur {
        background-color: #fdfeff47;
        -webkit-backdrop-filter: blur(5px);
        backdrop-filter: blur(5px);
        border-radius: 10px;
    }

    .row {
        margin: 0px;
    }

    .card {
        border-radius: 0.1rem !important;
    }

    .card-header {
        background-color: rgba(0, 0, 0, .0) !important;
    }

    .card-footer {
        background-color: rgba(0, 0, 0, .0) !important;
    }

    h5.nama-instansi {
        margin-bottom: 0.1rem;
    }

    .slider-overlay {
        display: none;
        position: fixed;
        inset: 0;
        width: 100vw;
        height: 100vh;
        background-color: #000;
        z-index: 1050;
        cursor: pointer;
        overflow: hidden;
    }

    .slider-overlay-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
        opacity: 0;
        transition: opacity 0.6s ease-in-out;
        pointer-events: none;
    }

    .slider-overlay-img.active {
        opacity: 1;
    }

    .slider-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 56px;
        height: 56px;
        border: none;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, .15);
        color: #fff;
        font-size: 1.6rem;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1060;
        transition: background-color .2s ease, transform .2s ease;
    }

    .slider-nav:hover {
        background-color: rgba(255, 255, 255, .35);
        transform: translateY(-50%) scale(1.08);
    }

    .slider-nav-prev {
        left: 24px;
    }

    .slider-nav-next {
        right: 24px;
    }

    .slider-dots {
        position: absolute;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 1060;
    }

    .slider-dot {
        width: 12px;
        height: 12px;
        padding: 0;
        border: none;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, .4);
        cursor: pointer;
        transition: background-color .2s ease, transform .2s ease;
    }

    .slider-dot.active {
        background-color: #fff;
        transform: scale(1.25);
    }
</style>