<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
        }

        .sidebar {
            flex-shrink: 0;
        }

        .content {
            overflow-y: auto;
        }

        .submenu {
            margin-left: 1rem;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 50;
        }

        .modal {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 750px;
            max-width: 90%;
            transform: scale(0.8);
            opacity: 0;
            transition: all 0.3s ease-in-out;
        }

        .modal.show {
            transform: scale(1);
            opacity: 1;
        }

        .modal-overlay.show {
            display: flex;
        }

        .module-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .collapse-icon {
            transition: transform 0.3s ease;
        }

        .collapsed .collapse-icon {
            transform: rotate(-90deg);
        }

        .submenu {
            margin-left: 1rem;
            overflow: hidden;
            max-height: 1000px;
            transition: max-height 0.3s ease;
        }

        .collapsed .submenu {
            max-height: 0;
        }
    </style>
    <link rel="icon" href="/img/logo.png" type="image/png">
</head>

<body>
    <div class="sidebar w-64 overflow-y-auto bg-gray-100 p-4 h-full border-r border-gray-300">
        <!-- Logo aplikasi -->
        <div class="mb-4 flex flex-col items-center">
            <img src="/img/logo.png" alt="App Logo" style="max-height: 80px;">
            <div class="text-lg font-bold mt-4">API Klinik Sari Dharma</div>
            <small class="text-gray-500">
                Created by <a href="https://github.com/aacassandra" class="text-blue-500 hover:underline">aacassandra</a>
            </small>
        </div>

        <!-- Token Input Section -->
        <div class="mb-6 p-3 bg-white rounded shadow-sm">
            <h3 class="text-sm font-semibold mb-2">API Token</h3>
            <input id="api-token" type="text" class="w-full border rounded p-2 text-xs mb-2"
                placeholder="Paste your token here">
            <button id="save-token" class="w-full bg-green-500 text-white rounded py-1 px-2 text-sm">Save Token</button>
        </div>

        <div id="sidebar-links" class="space-y-2">Loading...</div>
    </div>
    <div class="content flex-1 p-6">
        <h1 class="text-2xl font-bold mb-4">API Documentation</h1>
        <p class="mb-6">Berikut adalah dokumentasi untuk API yang tersedia di aplikasi <b>Klinik Sari Dharma</b>.</p>
        <div id="documentation" class="space-y-8">Loading...</div>
    </div>

    <!-- Modal -->
    <div id="modal-overlay" class="modal-overlay">
        <div class="modal">
            <h2 class="text-lg font-bold mb-4">Try API</h2>
            <div class="mb-4">
                <label class="block font-medium">URL</label>
                <input id="modal-url" type="text" class="w-full border rounded p-2">
            </div>
            <div class="mb-4">
                <label class="block font-medium">Method</label>
                <select id="modal-method" class="w-full border rounded p-2">
                    <option value="GET">GET</option>
                    <option value="POST">POST</option>
                    <option value="PUT">PUT</option>
                    <option value="DELETE">DELETE</option>
                </select>
            </div>
            <!-- Tambahan: Input untuk Headers (JSON) -->
            <div class="mb-4">
                <label class="block font-medium">Headers (JSON)</label>
                <textarea id="modal-headers" class="w-full border rounded p-2 text-sm" rows="3" placeholder='{"Authorization": "Bearer ..."}'></textarea>
            </div>
            <!-- Body Tabs Container -->
            <div id="modal-body-container" class="mb-4 hidden">
                <label class="block font-medium mb-2">Body</label>
                <!-- Tabs -->
                <div class="flex border-b mb-2">
                    <button id="json-tab"
                        class="py-2 px-4 mr-1 border-b-2 border-blue-500 font-medium text-sm">JSON</button>
                    <button id="formdata-tab" class="py-2 px-4 text-gray-500 font-medium text-sm">Form Data</button>
                </div>
                <!-- JSON Tab Content -->
                <div id="json-tab-content">
                    <textarea id="modal-body-json" class="w-full border rounded p-2 text-sm" rows="5"></textarea>
                </div>
                <!-- FormData Tab Content -->
                <div id="formdata-tab-content" class="hidden">
                    <div id="formdata-fields" class="space-y-2">
                        <!-- Form data fields will be added here dynamically -->
                    </div>
                    <button id="add-field-btn" class="mt-2 bg-gray-200 text-gray-700 py-1 px-2 rounded text-sm">Add
                        Field</button>
                </div>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Response <small>(HTTP Code included)</small></label>
                <pre id="modal-response" class="w-full border rounded p-2 bg-gray-50 h-40 text-sm overflow-auto"></pre>
            </div>
            <div class="flex justify-end space-x-2">
                <button id="modal-close" class="px-4 py-2 bg-gray-300 rounded">Close</button>
                <button id="modal-send" class="px-4 py-2 bg-blue-500 text-white rounded">Send</button>
            </div>
        </div>
    </div>

    <script>
        let modalOverlay = document.getElementById('modal-overlay');
        let modal = document.querySelector('.modal'); // Tambahkan ini
        let modalUrl = document.getElementById('modal-url');
        let modalMethod = document.getElementById('modal-method');
        let modalBodyContainer = document.getElementById('modal-body-container');
        let modalBodyJson = document.getElementById('modal-body-json');
        let formdataFields = document.getElementById('formdata-fields');
        let addFieldBtn = document.getElementById('add-field-btn');
        let jsonTab = document.getElementById('json-tab');
        let formdataTab = document.getElementById('formdata-tab');
        let jsonTabContent = document.getElementById('json-tab-content');
        let formdataTabContent = document.getElementById('formdata-tab-content');
        let modalResponse = document.getElementById('modal-response');
        let modalClose = document.getElementById('modal-close');
        let modalSend = document.getElementById('modal-send');
        let apiToken = document.getElementById('api-token');
        let saveTokenBtn = document.getElementById('save-token');
        let modalHeaders = document.getElementById('modal-headers');

        // Active tab for body (json or formdata)
        let activeBodyTab = 'json';

        // Load token from localStorage on page load
        document.addEventListener('DOMContentLoaded', () => {
            const savedToken = localStorage.getItem('api_token');
            if (savedToken) {
                apiToken.value = savedToken;
            }
        });

        // Save token to localStorage
        saveTokenBtn.addEventListener('click', () => {
            const token = apiToken.value.trim();
            if (token) {
                localStorage.setItem('api_token', token);
                alert('Token saved successfully!');
            } else {
                alert('Please enter a valid token');
            }
        });

        // Tab switching
        jsonTab.addEventListener('click', () => {
            jsonTab.classList.add('border-b-2', 'border-blue-500');
            jsonTab.classList.remove('text-gray-500');
            formdataTab.classList.remove('border-b-2', 'border-blue-500');
            formdataTab.classList.add('text-gray-500');

            jsonTabContent.classList.remove('hidden');
            formdataTabContent.classList.add('hidden');

            activeBodyTab = 'json';
        });

        formdataTab.addEventListener('click', () => {
            formdataTab.classList.add('border-b-2', 'border-blue-500');
            formdataTab.classList.remove('text-gray-500');
            jsonTab.classList.remove('border-b-2', 'border-blue-500');
            jsonTab.classList.add('text-gray-500');

            formdataTabContent.classList.remove('hidden');
            jsonTabContent.classList.add('hidden');

            activeBodyTab = 'formdata';
        });

        // Add form data field
        addFieldBtn.addEventListener('click', () => {
            const fieldRow = document.createElement('div');
            fieldRow.className = 'flex space-x-2 items-center';

            const keyInput = document.createElement('input');
            keyInput.type = 'text';
            keyInput.className = 'flex-1 border rounded p-1 text-sm';
            keyInput.placeholder = 'Key';

            const valueInput = document.createElement('input');
            valueInput.type = 'text';
            valueInput.className = 'flex-1 border rounded p-1 text-sm';
            valueInput.placeholder = 'Value';

            const fileCheckbox = document.createElement('input');
            fileCheckbox.type = 'checkbox';
            fileCheckbox.className = 'ml-1';

            const fileLabel = document.createElement('label');
            fileLabel.className = 'text-xs';
            fileLabel.textContent = 'File';

            const removeBtn = document.createElement('button');
            removeBtn.className = 'text-red-500 px-1';
            removeBtn.textContent = '×';
            removeBtn.onclick = function() {
                fieldRow.remove();
            };

            // Switch to file input when checkbox is checked
            fileCheckbox.addEventListener('change', (e) => {
                const parent = e.target.parentElement;
                const valueInput = parent.querySelector('input[type="text"]:nth-of-type(2)');

                if (e.target.checked) {
                    const fileInput = document.createElement('input');
                    fileInput.type = 'file';
                    fileInput.className = 'flex-1 border rounded p-1 text-xs';
                    parent.replaceChild(fileInput, valueInput);
                } else {
                    const textInput = document.createElement('input');
                    textInput.type = 'text';
                    textInput.className = 'flex-1 border rounded p-1 text-sm';
                    textInput.placeholder = 'Value';
                    parent.replaceChild(textInput, parent.querySelector('input[type="file"]'));
                }
            });

            fieldRow.appendChild(keyInput);
            fieldRow.appendChild(valueInput);
            fieldRow.appendChild(fileCheckbox);
            fieldRow.appendChild(fileLabel);
            fieldRow.appendChild(removeBtn);

            formdataFields.appendChild(fieldRow);
        });

        // Open modal
        function openModal(url, method, payload) {
            modalUrl.value = url;
            modalMethod.value = method;
            modalBodyJson.value = payload ? JSON.stringify(payload, null, 4) : '';
            modalBodyContainer.classList.toggle('hidden', method === 'GET' || method === 'DELETE');

            // Reset form data fields
            formdataFields.innerHTML = '';

            // If there's payload, add form fields for FormData tab
            if (payload && typeof payload === 'object') {
                Object.entries(payload).forEach(([key, value]) => {
                    addFieldBtn.click(); // Add a new field row
                    const lastRow = formdataFields.lastElementChild;
                    const inputs = lastRow.querySelectorAll('input[type="text"]');
                    if (inputs.length >= 2) {
                        inputs[0].value = key;
                        inputs[1].value = value;
                    }
                });
            }

            // Reset to JSON tab
            jsonTab.click();

            modalResponse.textContent = '';
            modalOverlay.classList.add('show');
            modal.classList.add('show'); // Tambahkan ini
        }

        // Close modal
        function closeModal() {
            modalOverlay.classList.remove('show');
            modal.classList.remove('show'); // Tambahkan ini
        }

        // Send API request
        modalSend.addEventListener('click', () => {
            const url = modalUrl.value;
            const method = modalMethod.value;
            const token = localStorage.getItem('api_token');

            const headers = {};
            if (token) {
                headers['Authorization'] = `Bearer ${token}`;
            }
            // Ambil headers dari kotak input JSON (jika ada)
            if(modalHeaders.value.trim()){
                try {
                    const customHeaders = JSON.parse(modalHeaders.value);
                    Object.assign(headers, customHeaders);
                } catch(e) {
                    modalResponse.textContent = `Header JSON Parse Error: ${e.message}`;
                    return;
                }
            }

            let requestData = null;

            // Prepare request data based on active tab
            if (activeBodyTab === 'json') {
                try {
                    requestData = modalBodyJson.value ? JSON.parse(modalBodyJson.value) : null;
                    headers['Content-Type'] = 'application/json';
                } catch (e) {
                    modalResponse.textContent = `JSON Parse Error: ${e.message}`;
                    return;
                }
            } else {
                const formData = new FormData();
                const fieldRows = formdataFields.querySelectorAll('div');

                fieldRows.forEach(row => {
                    const keyInput = row.querySelector('input:nth-of-type(1)');
                    const key = keyInput.value.trim();

                    if (key) {
                        const fileCheckbox = row.querySelector('input[type="checkbox"]');

                        if (fileCheckbox.checked) {
                            const fileInput = row.querySelector('input[type="file"]');
                            if (fileInput.files.length > 0) {
                                formData.append(key, fileInput.files[0]);
                            }
                        } else {
                            const valueInput = row.querySelector('input:nth-of-type(2)');
                            formData.append(key, valueInput.value);
                        }
                    }
                });

                requestData = formData;
                // Don't set Content-Type for FormData as axios will set it with boundary
            }

            axios({
                    url,
                    method,
                    data: requestData,
                    headers: headers
                })
                .then(response => {
                    modalResponse.textContent = "HTTP Response Code: " + response.status + "\n" + JSON.stringify(response.data, null, 4);
                })
                .catch(error => {
                    const status = error.response ? error.response.status : 'Error';
                    modalResponse.textContent = "HTTP Response Code: " + status + "\n" + JSON.stringify(error.response?.data || error.message, null, 4);
                });
        });

        // Close modal when clicking outside
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) closeModal();
        });

        // Close modal on button click
        modalClose.addEventListener('click', closeModal);

        // Close modal on Esc key press
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Fetch available models dynamically (use token if available)
        const fetchModels = () => {
            const token = localStorage.getItem('api_token');
            const headers = {};

            if (token) {
                headers['Authorization'] = `Bearer ${token}`;
            }

            fetch('/api/api-documentation/models', {
                    headers
                })
                .then(response => response.json())
                .then(data => {
                    const sidebarLinks = document.getElementById('sidebar-links');
                    const documentationContainer = document.getElementById('documentation');

                    if (data.success) {
                        sidebarLinks.innerHTML = '';
                        documentationContainer.innerHTML = '';

                        for (const [modelName, modelData] of Object.entries(data.data)) {
                            // Add module link to sidebar
                            const moduleLink = document.createElement('div');
                            moduleLink.className = "mb-4";

                            // Create title container with collapse functionality
                            const moduleTitleContainer = document.createElement('div');
                            moduleTitleContainer.className = "module-title";
                            moduleLink.appendChild(moduleTitleContainer);

                            // Add collapse icon
                            const collapseIcon = document.createElement('span');
                            collapseIcon.className = "collapse-icon";
                            collapseIcon.innerHTML = '&#9660;'; // Down arrow

                            const moduleTitle = document.createElement('a');
                            moduleTitle.href = `#${modelName}`;
                            moduleTitle.textContent = modelName;
                            moduleTitle.className = "block text-gray-700 font-bold hover:text-blue-500";

                            moduleTitleContainer.appendChild(moduleTitle);
                            moduleTitleContainer.appendChild(collapseIcon);

                            // Setup collapse functionality
                            moduleLink.classList.add('collapsed'); // Start collapsed

                            moduleTitleContainer.addEventListener('click', (e) => {
                                if (e.target !== moduleTitle) {
                                    e.preventDefault();
                                }
                                // Close all other open module links (submenu) by adding 'collapsed'
                                const allModuleLinks = document.querySelectorAll('#sidebar-links > .mb-4');
                                allModuleLinks.forEach(link => {
                                    if (link !== moduleLink) {
                                        link.classList.add('collapsed');
                                    }
                                });
                                // Toggle current submenu
                                moduleLink.classList.toggle('collapsed');
                            });

                            // Add submenu for endpoints
                            const submenu = document.createElement('div');
                            submenu.className = "submenu space-y-1";

                            for (const [operation, details] of Object.entries(modelData.endpoints)) {
                                const submenuItem = document.createElement('div');
                                submenuItem.className = "flex items-center";

                                const operationLink = document.createElement('a');
                                operationLink.href = `#${modelName}-${operation}`;
                                operationLink.textContent = operation.replace('_', ' ').toUpperCase();
                                operationLink.className = "block text-gray-600 hover:text-blue-400";
                                submenuItem.appendChild(operationLink);

                                // Add Try button (separate from link)
                                const tryButton = document.createElement('button');
                                tryButton.textContent = 'Try';
                                tryButton.className = "ml-2 px-2 py-1 bg-blue-500 text-white rounded text-sm";
                                tryButton.onclick = function(e) {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    openModal(details.url, details.method, details.payload);
                                };
                                submenuItem.appendChild(tryButton);

                                submenu.appendChild(submenuItem);
                            }

                            moduleLink.appendChild(submenu);
                            sidebarLinks.appendChild(moduleLink);

                            // Add documentation content
                            const modelSection = document.createElement('div');
                            modelSection.id = modelName;
                            modelSection.innerHTML = `
                            <h2 class="text-xl font-semibold">${modelName}</h2>
                            <h3 class="text-lg font-medium mt-4">Fields</h3>
                            <pre class="bg-gray-50 p-4 rounded border">${JSON.stringify(modelData.fields, null, 4)}</pre>
                            
                            <h3 class="text-lg font-medium mt-10 mb-5">Endpoints</h3>
                        `;

                            for (const [operation, details] of Object.entries(modelData.endpoints)) {
                                modelSection.innerHTML += `
                                <h4 id="${modelName}-${operation}" class="text-md font-medium mt-2">${operation.replace('_', ' ').toUpperCase()}</h4>
                                <p><strong>URL:</strong> ${details.url}</p>
                                <p><strong>Method:</strong> ${details.method}</p>
                                <p class="mt-5"><strong>Payload:</strong></p>
                                <pre class="bg-gray-50 p-4 rounded border">${details.payload ? JSON.stringify(details.payload, null, 4) : 'N/A'}</pre>
                                ${details.validations && details.validations !== 'N/A' ? `
                                    <p class="mt-5"><strong>Validations:</strong></p>
                                    <pre class="bg-gray-50 p-4 rounded border">${JSON.stringify(details.validations, null, 4)}</pre>
                                    ` : ''}
                                ${details.query_params ? `
                                    <p class="mt-5"><strong>Query Parameters:</strong></p>
                                    <ul>
                                        ${Object.entries(details.query_params).map(([param, desc]) => `<li><span class="text-red-500">${param}:</span> ${desc}</li>`).join('')}
                                    </ul>
                                    ` : ''}
                                <p class="mt-5"><strong>Response:</strong></p>
                                <pre class="bg-gray-50 p-4 rounded border">${JSON.stringify(details.response, null, 4)}</pre>
                                <div class="border-b-2 border-gray-500 border-dashed my-20"></div>
                            `;
                            }

                            documentationContainer.appendChild(modelSection);
                        }
                    } else {
                        sidebarLinks.textContent = 'Failed to load modules.';
                        documentationContainer.textContent = 'Failed to load documentation.';
                    }
                })
                .catch(error => {
                    const sidebarLinks = document.getElementById('sidebar-links');
                    const documentationContainer = document.getElementById('documentation');
                    sidebarLinks.textContent = `Error: ${error.message}`;
                    documentationContainer.textContent = `Error: ${error.message}`;
                });
        };

        // Initial fetch
        fetchModels();
    </script>
</body>

</html>
