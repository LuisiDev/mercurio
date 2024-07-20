document.addEventListener("DOMContentLoaded", function () {
    window.requestAnimFrame = (function(callback) {
        return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
            window.setTimeout(callback, 1000 / 60);
        };
    })();

    var canvas = document.getElementById("draw-canvas");
    var ctx = canvas.getContext("2d");

    var drawText = document.getElementById("draw-dataUrl");
    var drawImage = document.getElementById("draw-image");
    var clearBtn = document.getElementById("draw-clearBtn");
    var submitBtn = document.getElementById("draw-submitBtn");

    clearBtn.addEventListener("click", function(e) {
        clearCanvas();
        drawImage.setAttribute("src", "");
        drawImage.classList.add("hidden");
    }, false);

    submitBtn.addEventListener("click", function(e) {
        var dataUrl = canvas.toDataURL();
        drawText.innerHTML = dataUrl;
        drawImage.setAttribute("src", dataUrl);
        drawImage.classList.remove("hidden");
        document.getElementById("firma").value = dataUrl;
    }, false);

    var drawing = false;
    var mousePos = { x: 0, y: 0 };
    var lastPos = mousePos;

    canvas.addEventListener("mousedown", function(e) {
        drawing = true;
        lastPos = getMousePos(canvas, e);
    }, false);

    canvas.addEventListener("mouseup", function(e) {
        drawing = false;
    }, false);

    canvas.addEventListener("mousemove", function(e) {
        mousePos = getMousePos(canvas, e);
    }, false);

    canvas.addEventListener("touchstart", function(e) {
        mousePos = getTouchPos(canvas, e);
        e.preventDefault();
        var touch = e.touches[0];
        var mouseEvent = new MouseEvent("mousedown", {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(mouseEvent);
    }, false);

    canvas.addEventListener("touchend", function(e) {
        e.preventDefault();
        var mouseEvent = new MouseEvent("mouseup", {});
        canvas.dispatchEvent(mouseEvent);
    }, false);

    canvas.addEventListener("touchleave", function(e) {
        e.preventDefault();
        var mouseEvent = new MouseEvent("mouseup", {});
        canvas.dispatchEvent(mouseEvent);
    }, false);

    canvas.addEventListener("touchmove", function(e) {
        var touch = e.touches[0];
        var mouseEvent = new MouseEvent("mousemove", {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(mouseEvent);
    }, false);

    function getMousePos(canvasDom, mouseEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: mouseEvent.clientX - rect.left,
            y: mouseEvent.clientY - rect.top
        };
    }

    function getTouchPos(canvasDom, touchEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: touchEvent.touches[0].clientX - rect.left,
            y: touchEvent.touches[0].clientY - rect.top
        };
    }

    function renderCanvas() {
        if (drawing) {
            ctx.strokeStyle = "#000000"; // default color
            ctx.lineWidth = 1; // default line width
            ctx.beginPath();
            ctx.moveTo(lastPos.x, lastPos.y);
            ctx.lineTo(mousePos.x, mousePos.y);
            ctx.stroke();
            ctx.closePath();
            lastPos = mousePos;
        }
    }

    function clearCanvas() {
        canvas.width = canvas.width;
    }

    (function drawLoop() {
        requestAnimFrame(drawLoop);
        renderCanvas();
    })();
});