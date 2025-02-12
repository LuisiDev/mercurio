<div id="popup-user-add" tabindex="-1" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-3xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Añadir artículo
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="popup-user-add">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Cerrar</span>
                </button>
            </div>
            <form action="../procesos/articulo-new" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-4">

                    <div class="col-span-2">
                        <label for="artNombre"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre
                            *</label>
                        <input name="artNombre" id="artNombre" type="text"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Nombre de identificación..." required></input>
                    </div>
                    <div class="col-span-2">
                        <label for="artSubNombre"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre
                            alternativo (Subnombre)</label>
                        <input name="artSubNombre" id="artSubNombre" type="text"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Subnombre..."></input>
                    </div>
                    <div class="col-span-2">
                        <label for="marca"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Marca</label>
                        <input name="marca" id="marca" type="text"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Marca..."></input>
                    </div>
                    <div class="col-span-2">
                        <label for="categoria"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría
                            *</label>
                        <select name="categoria" id="categoria"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option selected>Seleccionar tipo de categoría</option>
                            <option value="1">Dispositivo</option>
                            <option value="2">Cámara</option>
                            <option value="3">Sensor</option>
                            <option value="4">Accesorio</option>
                        </select>
                    </div>
                    <div>
                        <label for="precioPublico"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio al
                            público</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2" />
                                </svg>
                            </div>
                            <input name="precioPublico" id="precioPublico" type="text"
                                class="block p-2.5 ps-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="000.00" oninput="formatCurrency(this)"></input>
                        </div>
                        <script>
                            function formatCurrency(input) {
                                let value = input.value.replace(/,/g, '');
                                if (!isNaN(value) && value.length > 0) {
                                    let formattedValue = parseFloat(value).toFixed(2).toString();
                                    if (value.length > 4) {
                                        formattedValue = formattedValue.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                    let cursorPosition = input.selectionStart;
                                    input.value = formattedValue;
                                    input.setSelectionRange(cursorPosition, cursorPosition);
                                } else {
                                    input.value = '000.00';
                                }
                            }
                        </script>
                    </div>
                    <div>
                        <label for="precioInstalacion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio de
                            instalación</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2" />
                                </svg>
                            </div>
                            <input name="precioInstalacion" id="precioInstalacion" type="text"
                                class="block p-2.5 ps-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="000.00" oninput="formatCurrency(this)"></input>
                        </div>
                    </div>
                    <div>
                        <label for="comComercial"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comisión
                            comercial</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2" />
                                </svg>
                            </div>
                            <input name="comComercial" id="comComercial" type="text"
                                class="block p-2.5 ps-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="000.00" oninput="formatCurrency(this)"></input>
                        </div>
                    </div>
                    <div>
                        <label for="comInstalacion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comisión de
                            instalación</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2" />
                                </svg>
                            </div>
                            <input name="comInstalacion" id="comInstalacion" type="text"
                                class="block p-2.5 ps-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="000.00" oninput="formatCurrency(this)"></input>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="tipo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Concepto
                            *</label>
                        <select name="concepto" id="concepto"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option selected>Seleccionar tipo de concepto</option>
                            <option value="0">No aplica</option>
                            <option value="1">Concepto A</option>
                            <option value="2">Concepto B</option>
                            <option value="3">Concepto C</option>
                            <option value="4">Concepto D</option>
                            <option value="5">Concepto E</option>
                            <option value="6">Concepto F</option>
                            <option value="7">Concepto G</option>
                            <option value="8">Concepto H</option>
                            <option value="9">Concepto I</option>
                        </select>
                        <a href="../../../Grupo-Cardinales/Atlantida/src/documentacion/conceptos" target="_blank"
                            id="helper-text-explanation" class="mt-2 text-sm text-blue-700 dark:text-blue-500">Ver lista
                            de conceptos y sus productos.
                            <svg class="w-4 mb-0.5 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="4"
                                    d="M28 6h14v14m0 9.474V39a3 3 0 0 1-3 3H9a3 3 0 0 1-3-3V9a3 3 0 0 1 3-3h9m7.8 16.2L41.1 6.9" />
                            </svg>
                        </a>
                    </div>
                    <div class="col-span-2">
                        <label for="tipo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paquete
                            *</label>
                        <select name="opcionPaquete" id="opcionPaquete"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option selected>Seleccionar tipo de paquete</option>
                            <option value="0">No aplica</option>
                            <option value="1">En varios paquetes</option>
                            <option value="2">Paquete platino</option>
                            <option value="3">Paquete oro</option>
                            <option value="4">Paquete plata</option>
                            <option value="5">Paquete bronce</option>
                        </select>
                        <a href="../../../Grupo-Cardinales/Atlantida/src/documentacion/paquetes" target="_blank"
                            id="helper-text-explanation" class="mt-2 text-sm text-blue-700 dark:text-blue-500">Ver lista
                            de paquetes y sus productos.
                            <svg class="w-4 mb-0.5 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="4"
                                    d="M28 6h14v14m0 9.474V39a3 3 0 0 1-3 3H9a3 3 0 0 1-3-3V9a3 3 0 0 1 3-3h9m7.8 16.2L41.1 6.9" />
                            </svg>
                        </a>
                    </div>

                    <!-- Si se selecciona la opción de "En varios paquetes" aparecerá los checkbox de los paquetes -->
                    <div class="col-span-4 hidden" id="paquetes">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paquetes</label>
                        <div class="grid gap-4 grid-cols-4">
                            <div>
                                <input type="checkbox" name="paquetes[]" id="paquete1" value="2"
                                    class="text-blue-600 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:text-blue-500 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label for="paquete1" class="text-sm text-gray-900 dark:text-white">Paquete
                                    platino</label>
                            </div>
                            <div>
                                <input type="checkbox" name="paquetes[]" id="paquete2" value="3"
                                    class="text-blue-600 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:text-blue-500 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label for="paquete2" class="text-sm text-gray-900 dark:text-white">Paquete oro</label>
                            </div>
                            <div>
                                <input type="checkbox" name="paquetes[]" id="paquete3" value="4"
                                    class="text-blue-600 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:text-blue-500 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label for="paquete3" class="text-sm text-gray-900 dark:text-white">Paquete
                                    plata</label>
                            </div>
                            <div>
                                <input type="checkbox" name="paquetes[]" id="paquete4" value="5"
                                    class="text-blue-600 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:text-blue-500 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label for="paquete4" class="text-sm text-gray-900 dark:text-white">Paquete
                                    bronce</label>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById('opcionPaquete').addEventListener('change', function () {
                            const paquetesDiv = document.getElementById('paquetes');
                            if (this.value == '1') {
                                paquetesDiv.classList.remove('hidden');
                            } else {
                                paquetesDiv.classList.add('hidden');
                            }
                        });
                    </script>

                    <label for="artImg"
                        class="block mt-2 text-sm font-medium text-gray-900 dark:text-white">Imagen</label>
                    <div class="flex items-center justify-center w-full relative col-span-4">
                        <label for="artImg"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <div class="uploadText mx-auto text-center">
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Has
                                            click para subir el archivo o imagen</span>, o arrastraló aquí</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PDF, DOCX, PNG, JPEG, JPG.
                                    </p>
                                </div>
                            </div>
                            <input id="artImg" name="artImg" type="file" class="hidden"
                                accept=".pdf, .docx, .xlsx, .csv, .jpeg, .jpg, .png, .webp" />
                        </label>
                    </div>

                </div>
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Enviar</button>
                    <button data-modal-hide="popup-user-add" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var fileInputs = [
            "artImg"
        ];

        fileInputs.forEach(function (inputId) {
            var inputElement = document.getElementById(inputId);
            if (inputElement) {
                inputElement.addEventListener("change", function () {
                    var fileName = this.files[0].name;
                    var uploadTextElement = this.parentElement.querySelector(".uploadText");

                    if (uploadTextElement) {
                        uploadTextElement.textContent = fileName;
                        uploadTextElement.style.color = "green";
                    } else {
                        console.error('No se pudo encontrar el elemento uploadText para el input ' + inputId);
                    }
                });
            } else {
                console.error('No se pudo encontrar el input con el id ' + inputId);
            }
        });
    });
</script>