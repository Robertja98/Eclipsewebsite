// jsPDF CDN loader for browser
(function() {
    var script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js';
    script.onload = function() {
        window.jsPDFLoaded = true;
    };
    document.head.appendChild(script);
})();
