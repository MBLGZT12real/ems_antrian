 <!-- DataTables -->
 <link href="assets/vendor/css/datatables.min.css" type="text/css" rel="stylesheet">

 <style>
     .rest-overlay {
         display: none;
         position: fixed;
         inset: 0;
         width: 100vw;
         height: 100vh;
         background-color: #000;
         z-index: 1050;
     }

     .rest-overlay-img {
         width: 100%;
         height: 100%;
         object-fit: contain;
     }

     .rest-overlay-open {
         position: absolute;
         top: 20px;
         left: 20px;
         z-index: 1060;
         display: flex;
         align-items: center;
         gap: 6px;
         padding: 10px 22px;
         border: none;
         border-radius: 50px;
         background-color: rgba(255, 255, 255, .92);
         color: #198754;
         font-weight: 700;
         box-shadow: 0 4px 14px rgba(0, 0, 0, .35);
         transition: transform .2s ease, background-color .2s ease;
     }

     .rest-overlay-open:hover {
         background-color: #fff;
         color: #146c43;
         transform: scale(1.05);
     }
 </style>