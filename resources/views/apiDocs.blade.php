<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAKAE Works - Complete Interactive Swagger & API Studio (64 APIs)</title>
    <!-- Google Fonts & Bootstrap 5 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">

    <style>
        :root {
            --bg-dark: #0f172a;
            --bg-card: #1e293b;
            --border-color: #334155;
            --accent-primary: #38bdf8;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b0f19;
            color: var(--text-main);
            min-height: 100vh;
            margin: 0;
        }

        .swagger-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            border-bottom: 1px solid var(--border-color);
            padding: 12px 24px;
        }

        .method-badge {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            font-size: 0.7rem;
            padding: 3px 6px;
            border-radius: 0 !important;
            text-transform: uppercase;
        }

        .badge-get { background: #0284c7; color: #fff; }
        .badge-post { background: #16a34a; color: #fff; }
        .badge-put { background: #d97706; color: #fff; }
        .badge-delete { background: #dc2626; color: #fff; }

        .sidebar-item {
            padding: 8px 12px;
            border-bottom: 1px solid #1e293b;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .sidebar-item:hover, .sidebar-item.active {
            background: #1e293b;
            border-left: 3px solid var(--accent-primary);
        }

        .endpoint-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 0 !important;
            margin-bottom: 16px;
        }

        .endpoint-card-header {
            padding: 12px 16px;
            background: #0f172a;
            border-bottom: 1px solid #334155;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .code-block {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.82rem;
            background: #090d16;
            color: #38bdf8;
            padding: 12px;
            border: 1px solid #334155;
            border-radius: 0 !important;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .table-schema {
            color: #cbd5e1;
            font-size: 0.8rem;
        }

        .table-schema th {
            background: #0f172a;
            color: #94a3b8;
            border-bottom: 1px solid #334155;
            padding: 8px 12px;
        }

        .table-schema td {
            border-bottom: 1px solid #334155;
            padding: 8px 12px;
        }

        .form-control-dark {
            background: #090d16;
            border: 1px solid #334155;
            color: #f8fafc;
            font-size: 0.82rem;
            border-radius: 0 !important;
            height: 36px;
        }

        .form-control-dark:focus {
            background: #090d16;
            border-color: #38bdf8;
            color: #fff;
            box-shadow: none;
        }

        .status-code-badge {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 8px;
        }
    </style>
</head>
<body>

    <!-- TOP HEADER -->
    <header class="swagger-header d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary text-white p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="mdi mdi-api fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0 fw-bold text-white">NAKAE Works - Interactive Swagger & API Studio</h5>
                <span class="text-muted small">Complete 64 Mobile App REST APIs Specification & Live Testing Studio v1.0</span>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-success px-3 py-2 fw-bold" id="totalApiCountBadge">64 APIs LIVE</span>
            <a href="{{ url('/api/api-list') }}" class="btn btn-outline-light btn-sm px-3" style="font-size: 0.75rem;">
                <i class="mdi mdi-code-json me-1"></i> Raw JSON Catalog
            </a>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row g-0">

            <!-- LEFT SIDEBAR -->
            <div class="col-12 col-md-3 border-end border-secondary" style="background: #0d1322; min-height: calc(100vh - 65px);">
                <div class="p-2 border-bottom border-secondary">
                    <input type="text" id="apiSearchInput" class="form-control form-control-dark mb-2" placeholder="Search Endpoint or Name...">
                    <div class="d-flex gap-1">
                        <button class="btn btn-dark btn-sm text-white-50 flex-grow-1 p-1" style="font-size: 0.7rem;" onclick="filterCategory('ALL')">All</button>
                        <button class="btn btn-dark btn-sm text-info flex-grow-1 p-1" style="font-size: 0.7rem;" onclick="filterCategory('USER')">User</button>
                        <button class="btn btn-dark btn-sm text-warning flex-grow-1 p-1" style="font-size: 0.7rem;" onclick="filterCategory('VENDOR')">Vendor</button>
                        <button class="btn btn-dark btn-sm text-success flex-grow-1 p-1" style="font-size: 0.7rem;" onclick="filterCategory('WEB')">Shared</button>
                    </div>
                </div>

                <div id="sidebarList" style="max-height: calc(100vh - 160px); overflow-y: auto;">
                    <!-- API List Populated via JS -->
                </div>
            </div>

            <!-- MAIN WORKSPACE -->
            <div class="col-12 col-md-9 p-3 p-md-4" style="max-height: calc(100vh - 65px); overflow-y: auto;">

                <div id="selectedApiContainer">
                    <div class="text-center text-muted py-5">
                        <i class="mdi mdi-gesture-tap-button fs-1 text-secondary"></i>
                        <h6 class="mt-2 text-white">Select an API Endpoint from the sidebar to view specification & test live</h6>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        const baseUrl = "{{ url('/') }}";
        const rawUserApis = @json($userApis);
        const rawVendorApis = @json($vendorApis);
        const rawWebApis = @json($webApis);

        const apiCatalog = [];

        function parseUrlParams(url) {
            const params = [];
            const matches = url.match(/\{([^}]+)\}/g);
            if (matches) {
                matches.forEach(m => {
                    const paramName = m.replace('{', '').replace('}', '');
                    params.push({
                        name: paramName,
                        type: 'string/number',
                        required: true,
                        example: '1',
                        description: `URL Path parameter for ${paramName}`
                    });
                });
            }
            return params;
        }

        function extractPath(urlStr) {
            try {
                const u = new URL(urlStr);
                return u.pathname + u.search;
            } catch (e) {
                return urlStr.replace(baseUrl, "");
            }
        }

        // 1. Populate Customer APIs
        rawUserApis.forEach((item, idx) => {
            const cleanPath = extractPath(item.url);
            apiCatalog.push({
                id: "user_api_" + idx,
                name: item.name,
                method: item.method,
                path: cleanPath,
                category: "USER",
                categoryLabel: "Customer / User APIs",
                description: item.description,
                headers: [{ name: "Authorization", type: "Bearer Token", required: false, description: "User Bearer JWT Token" }],
                params: parseUrlParams(cleanPath),
                responseSample: { "status": true, "message": item.name + " Response", "data": [] }
            });
        });

        // 2. Populate Vendor APIs
        rawVendorApis.forEach((item, idx) => {
            const cleanPath = extractPath(item.url);
            apiCatalog.push({
                id: "vendor_api_" + idx,
                name: item.name,
                method: item.method,
                path: cleanPath,
                category: "VENDOR",
                categoryLabel: "Vendor Partner APIs",
                description: item.description,
                headers: [{ name: "Authorization", type: "Bearer Token", required: true, description: "Vendor Bearer JWT Token" }],
                params: parseUrlParams(cleanPath),
                responseSample: { "success": true, "message": item.name + " Response", "data": [] }
            });
        });

        // 3. Populate Web / Shared APIs
        rawWebApis.forEach((item, idx) => {
            const cleanPath = extractPath(item.url);
            apiCatalog.push({
                id: "web_api_" + idx,
                name: item.name,
                method: item.method,
                path: cleanPath,
                category: "WEB",
                categoryLabel: "Public / Shared APIs",
                description: item.description,
                headers: [{ name: "Accept", type: "application/json", required: true, description: "Expected response format" }],
                params: parseUrlParams(cleanPath),
                responseSample: { "status": true, "message": item.name + " Response", "data": [] }
            });
        });

        document.getElementById('totalApiCountBadge').innerText = `${apiCatalog.length} APIs LIVE`;

        let currentCategoryFilter = 'ALL';

        function filterCategory(cat) {
            currentCategoryFilter = cat;
            renderSidebar(document.getElementById('apiSearchInput').value);
        }

        function renderSidebar(filterText = '') {
            const container = document.getElementById('sidebarList');
            container.innerHTML = '';

            let filtered = apiCatalog;

            if (currentCategoryFilter !== 'ALL') {
                filtered = filtered.filter(item => item.category === currentCategoryFilter);
            }

            if (filterText) {
                filtered = filtered.filter(item => 
                    item.name.toLowerCase().includes(filterText.toLowerCase()) || 
                    item.path.toLowerCase().includes(filterText.toLowerCase()) ||
                    item.categoryLabel.toLowerCase().includes(filterText.toLowerCase())
                );
            }

            filtered.forEach(item => {
                const badgeClass = `badge-${item.method.toLowerCase()}`;
                const div = document.createElement('div');
                div.className = 'sidebar-item';
                div.onclick = () => selectApi(item.id);
                div.innerHTML = `
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <span class="fw-bold text-white small text-truncate" style="max-width: 170px;">${item.name}</span>
                        <span class="method-badge ${badgeClass}">${item.method}</span>
                    </div>
                    <div class="text-muted small text-truncate" style="font-size: 0.68rem;">${item.path}</div>
                `;
                container.appendChild(div);
            });
        }

        function selectApi(apiId) {
            const item = apiCatalog.find(a => a.id === apiId);
            if (!item) return;

            const badgeClass = `badge-${item.method.toLowerCase()}`;
            const fullUrl = baseUrl + item.path;

            let paramsHtml = '';
            if (item.params.length > 0) {
                paramsHtml = `
                    <table class="table table-schema align-middle mt-2">
                        <thead>
                            <tr>
                                <th>Parameter</th>
                                <th>Type</th>
                                <th>Required</th>
                                <th>Description</th>
                                <th>Sample Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${item.params.map(p => `
                                <tr>
                                    <td><code>${p.name}</code></td>
                                    <td><span class="badge bg-secondary">${p.type}</span></td>
                                    <td>${p.required ? '<span class="text-danger fw-bold">REQUIRED</span>' : '<span class="text-muted">OPTIONAL</span>'}</td>
                                    <td>${p.description}</td>
                                    <td><code>${p.example}</code></td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                `;
            } else {
                paramsHtml = `<div class="text-muted small my-2">No URL path parameters required for this endpoint. Send JSON payload in body if POST/PUT.</div>`;
            }

            let formInputsHtml = '';
            if (item.params.length > 0) {
                formInputsHtml = item.params.map(p => `
                    <div class="mb-2">
                        <label class="form-label small text-muted mb-1">${p.name} ${p.required ? '*' : ''}</label>
                        <input type="text" id="input_${p.name}" class="form-control form-control-dark" value="${p.example}" placeholder="Enter ${p.name}">
                    </div>
                `).join('');
            } else if (item.method === 'POST' || item.method === 'PUT') {
                formInputsHtml = `
                    <div class="mb-2">
                        <label class="form-label small text-muted mb-1">Request Body JSON Payload</label>
                        <textarea id="input_json_body" class="form-control form-control-dark" rows="3" placeholder='{ "key": "value" }'></textarea>
                    </div>
                `;
            }

            const html = `
                <div class="endpoint-card">
                    <div class="endpoint-card-header">
                        <div class="d-flex align-items-center gap-2">
                            <span class="method-badge ${badgeClass}">${item.method}</span>
                            <h5 class="mb-0 fw-bold text-white">${item.name}</h5>
                        </div>
                        <span class="badge bg-dark border text-info">${item.categoryLabel}</span>
                    </div>
                    <div class="p-3">
                        <p class="text-muted small mb-3">${item.description}</p>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-white mb-1">ENDPOINT URL:</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-dark" value="${fullUrl}" readonly>
                                <button class="btn btn-outline-secondary btn-sm" onclick="navigator.clipboard.writeText('${fullUrl}')">
                                    <i class="mdi mdi-content-copy"></i> Copy
                                </button>
                            </div>
                        </div>

                        <!-- PARAMETERS SCHEMA -->
                        <h6 class="fw-bold text-white mt-4 mb-2" style="font-size: 0.85rem;">REQUEST PARAMETERS SCHEMA</h6>
                        ${paramsHtml}

                        <!-- SAMPLE RESPONSE SCHEMA -->
                        <h6 class="fw-bold text-white mt-4 mb-2" style="font-size: 0.85rem;">EXPECTED RESPONSE JSON SCHEMA</h6>
                        <div class="code-block">${JSON.stringify(item.responseSample, null, 4)}</div>

                        <!-- LIVE TEST INTERFACE (TRY IT OUT) -->
                        <div class="mt-4 p-3 border border-primary bg-dark">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="fw-bold text-primary mb-0" style="font-size: 0.9rem;">
                                    <i class="mdi mdi-flash me-1"></i> TRY IT OUT & EXECUTE API LIVE
                                </h6>
                            </div>

                            ${formInputsHtml}

                            <button type="button" class="btn btn-success px-4 py-2 fw-bold text-white mt-2" onclick="executeApi('${item.id}')">
                                <i class="mdi mdi-play me-1"></i> Execute API Request
                            </button>

                            <!-- LIVE RESPONSE OUTPUT -->
                            <div id="liveResponseContainer_${item.id}" class="mt-3" style="display: none;">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-bold text-white small">RESPONSE OUTPUT:</span>
                                    <span id="responseStatus_${item.id}" class="status-code-badge bg-success text-white">200 OK</span>
                                </div>
                                <div id="responseBody_${item.id}" class="code-block text-success">Executing...</div>
                            </div>
                        </div>

                    </div>
                </div>
            `;

            document.getElementById('selectedApiContainer').innerHTML = html;
        }

        async function executeApi(apiId) {
            const item = apiCatalog.find(a => a.id === apiId);
            if (!item) return;

            const resContainer = document.getElementById(`liveResponseContainer_${apiId}`);
            const resStatus = document.getElementById(`responseStatus_${apiId}`);
            const resBody = document.getElementById(`responseBody_${apiId}`);

            resContainer.style.display = 'block';
            resBody.innerText = 'Sending HTTP request to backend server...';

            let requestUrl = baseUrl + item.path;
            let options = {
                method: item.method,
                headers: {
                    'Accept': 'application/json'
                }
            };

            if (item.method === 'GET') {
                const queryParams = new URLSearchParams();
                item.params.forEach(p => {
                    const input = document.getElementById(`input_${p.name}`);
                    if (input && input.value) {
                        if (requestUrl.includes(`{${p.name}}`)) {
                            requestUrl = requestUrl.replace(`{${p.name}}`, encodeURIComponent(input.value));
                        } else {
                            queryParams.append(p.name, input.value);
                        }
                    }
                });
                if (queryParams.toString()) {
                    requestUrl += (requestUrl.includes('?') ? '&' : '?') + queryParams.toString();
                }
            } else if (item.method === 'POST' || item.method === 'PUT') {
                const jsonBodyInput = document.getElementById('input_json_body');
                if (jsonBodyInput && jsonBodyInput.value) {
                    options.headers['Content-Type'] = 'application/json';
                    options.body = jsonBodyInput.value;
                } else {
                    const bodyData = {};
                    item.params.forEach(p => {
                        const input = document.getElementById(`input_${p.name}`);
                        if (input && input.value) {
                            if (requestUrl.includes(`{${p.name}}`)) {
                                requestUrl = requestUrl.replace(`{${p.name}}`, encodeURIComponent(input.value));
                            } else {
                                bodyData[p.name] = input.value;
                            }
                        }
                    });
                    options.headers['Content-Type'] = 'application/json';
                    options.body = JSON.stringify(bodyData);
                }
            }

            try {
                const res = await fetch(requestUrl, options);
                resStatus.innerText = `${res.status} ${res.statusText}`;
                resStatus.className = res.ok ? 'status-code-badge bg-success text-white' : 'status-code-badge bg-danger text-white';

                const data = await res.json();
                resBody.innerText = JSON.stringify(data, null, 4);
            } catch (err) {
                resStatus.innerText = 'ERROR';
                resStatus.className = 'status-code-badge bg-danger text-white';
                resBody.innerText = 'Network Error / Failed to execute API: ' + err.message;
            }
        }

        document.getElementById('apiSearchInput').addEventListener('input', (e) => {
            renderSidebar(e.target.value);
        });

        // Initialize
        renderSidebar();
        if (apiCatalog.length > 0) {
            selectApi(apiCatalog[0].id);
        }
    </script>
</body>
</html>
