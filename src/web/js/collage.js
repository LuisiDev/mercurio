document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('collageCanvas');
    const previewCtx = canvas.getContext('2d');
    const imageInput = document.getElementById('evidenciaArribo');
    const hiddenCanvas = document.getElementById('hiddenCanvas');
    const submitButton = document.getElementById('submitButton');
    const hiddentCtx = hiddenCanvas.getContext('2d');
    

    let allImages = [];

    imageInput.addEventListener('change', function (event) {
        const fileInput = event.target;
        const files = fileInput.files;
        console.log('Archivos seleccionados:', files);

        if (files.length === 0) {
            console.error('No se seleccionaron archivos.');
            return;
        }

        const imageFiles = Array.from(files).filter(file => file.type.startsWith('image/'));

        if (imageFiles.length === 0) {
            console.error('No se seleccionaron imagenes validas');
            return;
        }

        previewCtx.clearRect(0, 0, canvas.width, canvas.height);
        hiddentCtx.clearRect(0, 0, hiddenCanvas.width, hiddenCanvas.height);
        imageFiles.forEach((file) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = new Image();
                img.src = e.target.result;
                img.onload = function () {
                    allImages.push(img);

                    drawAllImages(previewCtx, canvas.width, canvas.height);
                    drawAllImages(hiddentCtx, hiddenCanvas.width, hiddenCanvas.height);
                };
                img.onerror = function () {
                    console.error('Fallo al cargar la imagen', img.src);
                };
            };
            reader.onerror = function (e) {
                console.error('Fallo al leer el archivo', e.target.error);
            };
            reader.readAsDataURL(file);
        });
    });

    function drawAllImages(ctx, canvasWidth, canvasHeight) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        const cols = 2;
        const rows = 3;
        const cellWidth = canvas.width / cols;
        const cellHeight = canvas.height / rows;

        if(ctx === previewCtx){
            ctx.fillStyle = '#ccc';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.strokeStyle = '#000'; 
            ctx.lineWidth = 2; 
    
            for (let i = 1; i < cols; i++) {
                ctx.beginPath();
                ctx.moveTo(i * cellWidth, 0);
                ctx.lineTo(i * cellWidth, canvas.height);
                ctx.stroke();
            }
    
            for (let j = 1; j < rows; j++) {
                ctx.beginPath();
                ctx.moveTo(0, j * cellHeight);
                ctx.lineTo(canvas.width, j * cellHeight);
                ctx.stroke();
            }
        }


        allImages.forEach((img, index) => {
            const col = index % cols;
            const row = Math.floor(index / cols); 
            const x = col * cellWidth; 
            const y = row * cellHeight; 

            const aspectRatio = img.width / img.height;
            const cellAspectRatio = cellWidth / cellHeight;

            let sourceX, sourceY, sourceWidth, sourceHeight;
            if (aspectRatio > cellAspectRatio){
                sourceHeight = img.height;
                sourceWidth = imageInput.height * cellAspectRatio;
                sourceX = (img.width - sourceWidth) / 2;
                sourceY = 0;
            } else{
                sourceWidth = img.width;
                sourceHeight = img.width / cellAspectRatio;
                sourceX = 0;
                sourceY = (img.height - sourceHeight) / 2;
            }

            ctx.drawImage(img, sourceX, sourceY, sourceWidth, sourceHeight, x, y, cellWidth, cellHeight);
        });
    }

});