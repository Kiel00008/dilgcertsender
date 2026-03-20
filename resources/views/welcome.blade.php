﻿﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate Sender | Futuristic UI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Orbitron for futuristic titles, Inter for body -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-neon: #00f2ff;
            --secondary-neon: #7000ff;
            --bg-dark: #0a0b1e;
            --card-glass: rgba(255, 255, 255, 0.05);
            --border-glass: rgba(255, 255, 255, 0.1);
        }

        body {
            background-color: var(--bg-dark);
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(0, 242, 255, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(112, 0, 255, 0.05) 0%, transparent 40%);
            color: #e0e0e0;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .futuristic-title {
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
            letter-spacing: 4px;
            background: linear-gradient(to right, var(--primary-neon), var(--secondary-neon));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 20px rgba(0, 242, 255, 0.3);
        }

        .glass-card {
            background: var(--card-glass);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-glass);
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            border-color: rgba(0, 242, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(0, 242, 255, 0.1);
        }

        /* Progress Bar */
        .stepper-container {
            margin-bottom: 40px;
        }

        .progress-bar-custom {
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            position: relative;
            margin: 30px 0;
            border-radius: 2px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(to right, var(--primary-neon), var(--secondary-neon));
            box-shadow: 0 0 15px var(--primary-neon);
            width: 0%;
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .step-circles {
            display: flex;
            justify-content: space-between;
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            z-index: 1;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            background: var(--bg-dark);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: all 0.3s ease;
            position: relative;
        }

        .step-circle.active {
            border-color: var(--primary-neon);
            box-shadow: 0 0 15px var(--primary-neon);
            color: var(--primary-neon);
        }

        .step-circle.completed {
            background: var(--primary-neon);
            border-color: var(--primary-neon);
            color: var(--bg-dark);
        }

        .step-label {
            position: absolute;
            top: 50px;
            white-space: nowrap;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
            font-family: 'Orbitron', sans-serif;
        }

        .step-circle.active .step-label {
            color: var(--primary-neon);
        }

        /* Forms & Inputs */
        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-glass);
            color: #fff;
            border-radius: 10px;
            padding: 8px 12px;
            font-size: 0.9rem;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-neon);
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.2);
            color: #fff;
        }

        .btn-neon {
            background: transparent;
            border: 1px solid var(--primary-neon);
            color: var(--primary-neon);
            padding: 10px 25px;
            border-radius: 10px;
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-size: 0.85rem;
        }

        .btn-neon:hover {
            background: var(--primary-neon);
            color: var(--bg-dark);
            box-shadow: 0 0 25px var(--primary-neon);
        }

        .btn-neon-secondary {
            border-color: var(--secondary-neon);
            color: var(--secondary-neon);
        }

        .btn-neon-secondary:hover {
            background: var(--secondary-neon);
            color: #fff;
            box-shadow: 0 0 25px var(--secondary-neon);
        }

        /* Certificate Preview Area */
        #certificateContainer {
            position: relative;
            width: 100%;
            margin: 0 auto;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid var(--border-glass);
            background: rgba(0,0,0,0.2);
        }

        #previewImage {
            width: 100%;
            height: auto;
            display: block;
        }

        .draggable-field {
            position: absolute;
            cursor: move;
            user-select: none;
            color: #000;
            font-weight: bold;
            white-space: nowrap;
            line-height: 1;
            padding: 4px;
            border: 1px dashed transparent;
        }

        .draggable-field:hover {
            border-color: var(--primary-neon);
            background: rgba(0, 242, 255, 0.1);
        }

        .draggable-field.active {
            border-color: var(--primary-neon);
            background: rgba(0, 242, 255, 0.2);
            box-shadow: 0 0 10px var(--primary-neon);
        }

        /* Step Transitions */
        .step-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .step-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Custom File Upload */
        .file-upload-wrapper {
            border: 2px dashed var(--border-glass);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-wrapper:hover {
            border-color: var(--primary-neon);
            background: rgba(0, 242, 255, 0.03);
        }

        .upload-icon {
            font-size: 2.5rem;
            color: var(--primary-neon);
            margin-bottom: 10px;
            text-shadow: 0 0 15px var(--primary-neon);
        }

        /* Field Cards */
        .field-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-glass);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .field-card:hover {
            border-color: rgba(0, 242, 255, 0.2);
        }

        .field-card.active {
            border-color: var(--primary-neon);
            background: rgba(0, 242, 255, 0.05);
        }

        .field-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .remove-field {
            color: #ff4d4d;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .remove-field:hover {
            color: #ff1a1a;
        }

        .stepper {
            display: flex;
            align-items: stretch;
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 999px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.04);
        }

        .stepper-btn {
            width: 42px;
            border: none;
            background: transparent;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 700;
            font-size: 18px;
            line-height: 1;
        }

        .stepper-btn:hover {
            background: rgba(0, 242, 255, 0.08);
            color: var(--primary-neon);
        }

        .stepper-input {
            flex: 1;
            min-width: 0;
            text-align: center;
            background: transparent;
            border: none;
            color: #fff;
            padding: 8px 10px;
            font-variant-numeric: tabular-nums;
        }

        .stepper-input:focus {
            outline: none;
        }

        .stepper-input[type=number]::-webkit-outer-spin-button,
        .stepper-input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .stepper-input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <!-- Header -->
    <header class="text-center mb-5">
        <h1 class="futuristic-title mb-2">CERT-GEN v2.0</h1>
        <p class="text-secondary">DILG Certificate Automation System</p>
    </header>

    <!-- Progress Stepper -->
    <div class="stepper-container px-5">
        <div class="progress-bar-custom">
            <div class="progress-fill" id="progressFill"></div>
            <div class="step-circles">
                <div class="step-circle active" data-step="1">
                    1
                    <span class="step-label">Recipients</span>
                </div>
                <div class="step-circle" data-step="2">
                    2
                    <span class="step-label">Layout</span>
                </div>
                <div class="step-circle" data-step="3">
                    3
                    <span class="step-label">Finalize</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <form id="certificateForm" action="{{ route('certificates.bulk') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- STEP 1: UPLOAD CSV -->
                <div class="step-content active" id="step1">
                    <div class="glass-card p-5 text-center">
                        <h3 class="mb-4">1st Step: Upload CSV</h3>
                        <p class="text-secondary mb-4">Upload a CSV file first so the system can detect your available columns.</p>

                        <div class="file-upload-wrapper" onclick="document.getElementById('csvInput').click()">
                            <i class="fas fa-file-csv upload-icon"></i>
                            <h5 id="csvStatus">Select CSV database file</h5>
                            <p class="small text-secondary" id="csvDetectedColumns">Detected columns will appear here</p>
                            <input type="file" name="csv_file" id="csvInput" class="d-none" accept=".csv" required>
                        </div>

                        <div id="csvPreviewContainer" class="mt-4 d-none text-start">
                            <h6>Data Preview (First 5 records):</h6>
                            <div class="table-responsive">
                                <table class="table table-dark table-sm table-borderless" id="csvPreviewTable">
                                    <thead>
                                        <tr class="border-bottom border-secondary">
                                            <!-- Dynamic headers -->
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-5 d-flex justify-content-center">
                            <button type="button" class="btn btn-neon px-5" onclick="goToStep(2)">
                                Next: Layout <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: LAYOUT & TEMPLATE -->
                <div class="step-content" id="step2">
                    <div class="row g-4">
                        <!-- Left Side: Field Controls -->
                        <div class="col-md-4">
                            <div class="glass-card p-4 h-100">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4 class="m-0">Details</h4>
                                    <button type="button" class="btn btn-neon btn-sm" onclick="addField()">
                                        <i class="fas fa-plus me-1"></i> Add Field
                                    </button>
                                </div>
                                <p class="small text-secondary mb-4" id="csvColumnsHint"></p>
                                
                                <div id="fieldsList" style="max-height: 500px; overflow-y: auto; padding-right: 5px;">
                                    <!-- Dynamic fields will be added here -->
                                </div>

                                <div class="mt-4 pt-3 border-top border-secondary d-flex gap-2">
                                    <button type="button" class="btn btn-neon-secondary w-50" onclick="goToStep(1)">
                                        <i class="fas fa-arrow-left me-2"></i> Back
                                    </button>
                                    <button type="button" class="btn btn-neon w-50" onclick="goToStep(3)">
                                        Next <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Template & Preview -->
                        <div class="col-md-8">
                            <div class="glass-card p-4 h-100 text-center">
                                <div id="uploadArea">
                                    <h3 class="mb-4">Certificate Template</h3>
                                    <div class="file-upload-wrapper" onclick="document.getElementById('templateInput').click()">
                                        <i class="fas fa-certificate upload-icon"></i>
                                        <h5 id="templateStatus">Upload Template Image</h5>
                                        <p class="small text-secondary">Drag and drop or click to browse</p>
                                        <input type="file" name="template" id="templateInput" class="d-none" accept="image/*" required>
                                    </div>
                                </div>

                                <div id="previewArea" class="d-none mt-2">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="m-0">Live Preview</h5>
                                        <button type="button" class="btn btn-sm btn-outline-secondary text-light" onclick="resetTemplate()">
                                            <i class="fas fa-redo me-1"></i> Change Template
                                        </button>
                                    </div>
                                    <div id="certificateContainer">
                                        <img id="previewImage" src="" alt="Certificate Template">
                                        <!-- Draggable fields will be injected here -->
                                    </div>
                                    <p class="text-secondary small mt-2">
                                        <i class="fas fa-mouse-pointer me-1"></i> Drag labels to position them
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 3: FINALIZE -->
                <div class="step-content" id="step3">
                    <div class="glass-card p-5 text-center">
                        <i class="fas fa-paper-plane upload-icon mb-4"></i>
                        <h3 class="mb-3">Ready to Send</h3>
                        <p class="text-secondary mb-5">Everything looks good! Click the button below to generate and send certificates to all recipients.</p>
                        
                        <div class="alert alert-info bg-transparent border-info text-info mb-5 mx-auto" style="max-width: 500px;">
                            <i class="fas fa-info-circle me-2"></i>
                            The system will process the CSV and send each certificate as a PDF attachment.
                        </div>

                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-neon-secondary px-4" onclick="goToStep(2)">
                                <i class="fas fa-arrow-left me-2"></i> Review Layout
                            </button>
                            <button type="submit" class="btn btn-neon px-5 py-3">
                                <i class="fas fa-rocket me-2"></i> Launch Generation
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Hidden inputs for dynamic fields JSON -->
                <input type="hidden" name="fields_json" id="fieldsJson">
            </form>
        </div>
    </div>

    <!-- Success Message Toast/Alert -->
    @if(session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div class="glass-card p-3 border-success text-success animate__animated animate__fadeInUp">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        </div>
    @endif
</div>

<script>
    let currentStep = 1;
    const totalSteps = 3;
    let csvHeaders = [];
    let csvFirstRowLower = {};
    let csvReady = false;
    let fields = [
        { id: 'field_name', label: 'name', placeholder: 'RECIPIENT NAME', x: 50, y: 50, size: 36, color: '#000000' }
    ];

    function updateStepper() {
        const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
        document.getElementById('progressFill').style.width = `${progress}%`;

        document.querySelectorAll('.step-circle').forEach(circle => {
            const step = parseInt(circle.dataset.step);
            circle.classList.remove('active', 'completed');
            
            if (step === currentStep) {
                circle.classList.add('active');
            } else if (step < currentStep) {
                circle.classList.add('completed');
                circle.innerHTML = '<i class="fas fa-check"></i>';
            } else {
                circle.innerHTML = step;
            }
        });
    }

    function goToStep(step) {
        if (step > currentStep) {
            // Validation
            if (currentStep === 1 && !document.getElementById('csvInput').files[0]) {
                alert('Please upload a CSV file first.');
                return;
            }
            if (currentStep === 1 && !csvReady) {
                alert('CSV is still loading. Please wait a moment.');
                return;
            }
            if (currentStep === 2 && !document.getElementById('templateInput').files[0]) {
                alert('Please upload a certificate template.');
                return;
            }
        }

        document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
        document.getElementById(`step${step}`).classList.add('active');
        currentStep = step;
        updateStepper();

        // Sync fields JSON before moving to Step 2 or 3
        document.getElementById('fieldsJson').value = JSON.stringify(fields);
    }

    // Template Upload Preview
    document.getElementById('templateInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('templateStatus').innerText = file.name;
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
                document.getElementById('uploadArea').classList.add('d-none');
                document.getElementById('previewArea').classList.remove('d-none');
                renderFields();
            }
            reader.readAsDataURL(file);
        }
    });

    function resetTemplate() {
        document.getElementById('templateInput').value = '';
        document.getElementById('uploadArea').classList.remove('d-none');
        document.getElementById('previewArea').classList.add('d-none');
    }

    // Fields Management
    function addField() {
        const id = 'field_' + Date.now();
        fields.push({
            id: id,
            label: 'new_field',
            placeholder: 'NEW FIELD',
            x: 50,
            y: 60,
            size: 24,
            color: '#000000'
        });
        renderFields();
    }

    function removeField(id) {
        if (fields.length <= 1) {
            alert("You need at least one field.");
            return;
        }
        fields = fields.filter(f => f.id !== id);
        renderFields();
    }

    function updateField(id, prop, value) {
        const field = fields.find(f => f.id === id);
        if (field) {
            field[prop] = value;
            if (prop === 'label') {
                field.placeholder = value.toUpperCase();
                const sample = getFirstRowValue(value);
                field.display_text = (sample && String(sample).trim()) ? String(sample) : field.placeholder;
                const textInput = document.getElementById(`input_${id}_text`);
                if (textInput) textInput.value = field.display_text;
            }
            syncPreviewField(id);
        }
    }

    function parseCsvRows(text, maxRows) {
        const rows = [];
        let row = [];
        let current = '';
        let inQuotes = false;

        for (let i = 0; i < text.length; i++) {
            const ch = text[i];
            const next = text[i + 1];

            if (ch === '\"') {
                if (inQuotes && next === '\"') {
                    current += '\"';
                    i++;
                } else {
                    inQuotes = !inQuotes;
                }
                continue;
            }

            if (!inQuotes && (ch === '\n' || ch === '\r')) {
                if (ch === '\r' && next === '\n') i++;
                row.push(current);
                current = '';
                if (row.some(v => String(v).trim() !== '')) rows.push(row);
                row = [];
                if (maxRows && rows.length >= maxRows) break;
                continue;
            }

            if (!inQuotes && ch === ',') {
                row.push(current);
                current = '';
                continue;
            }

            current += ch;
        }

        if (!maxRows || rows.length < maxRows) {
            if (current.length || row.length) {
                row.push(current);
                if (row.some(v => String(v).trim() !== '')) rows.push(row);
            }
        }

        return rows;
    }

    function buildFirstRowLower(headers, row) {
        const map = {};
        headers.forEach((h, idx) => {
            map[String(h).trim().toLowerCase()] = (row && typeof row[idx] !== 'undefined') ? String(row[idx]).trim() : '';
        });

        const displayName = computeDisplayNameFromRow(headers, row);
        if (displayName) {
            if (!map.display_name) map.display_name = displayName;
            if (!map.name) map.name = displayName;
        }

        return map;
    }

    function normalizeHeader(header) {
        return String(header).toLowerCase().replace(/[^a-z0-9]+/g, '');
    }

    function firstNonEmptyByAliases(normalizedRow, aliases) {
        for (const alias of aliases) {
            const key = normalizeHeader(alias);
            const value = normalizedRow[key];
            if (typeof value !== 'string') continue;
            const cleaned = value.trim().replace(/\s+/g, ' ');
            if (cleaned) return cleaned;
        }
        return '';
    }

    function toMiddleInitial(middle) {
        const cleaned = String(middle || '').trim().replace(/\s+/g, ' ').replace(/\.+$/, '');
        if (!cleaned) return '';
        return cleaned.substring(0, 1).toUpperCase();
    }

    function computeDisplayNameFromRow(headers, row) {
        const normalizedRow = {};
        headers.forEach((h, idx) => {
            normalizedRow[normalizeHeader(h)] = (row && typeof row[idx] !== 'undefined') ? String(row[idx] ?? '') : '';
        });

        const fullAliases = ['FullName', 'full_name', 'fullName', 'fullname', 'Name', 'CompleteName'];
        const lastAliases = ['LastName', 'last_name', 'lastName', 'lastname', 'LN', 'Surname', 'FamilyName', 'family_name'];
        const firstAliases = ['FirstName', 'first_name', 'firstName', 'firstname', 'FN', 'GivenName', 'given_name'];
        const middleAliases = ['MiddleInitial', 'middle_initial', 'MI', 'MiddleName', 'middle_name', 'middlename'];

        const fullName = firstNonEmptyByAliases(normalizedRow, fullAliases);
        if (fullName) return fullName;

        const last = firstNonEmptyByAliases(normalizedRow, lastAliases);
        const first = firstNonEmptyByAliases(normalizedRow, firstAliases);
        const middle = firstNonEmptyByAliases(normalizedRow, middleAliases);
        const mi = toMiddleInitial(middle);

        if (last && first) return mi ? `${last}, ${first} ${mi}.` : `${last}, ${first}`;
        if (last) return last;
        if (first) return mi ? `${first} ${mi}.` : first;
        return '';
    }

    function getFirstRowValue(label) {
        if (!label) return '';
        return csvFirstRowLower[String(label).trim().toLowerCase()] ?? '';
    }

    function normalizeHexColor(value) {
        if (!value) return null;
        const v = String(value).trim().toUpperCase();
        if (/^#[0-9A-F]{6}$/.test(v)) return v;
        if (/^[0-9A-F]{6}$/.test(v)) return `#${v}`;
        return null;
    }

    function updateFieldColor(id, value) {
        const normalized = normalizeHexColor(value);
        if (!normalized) return;
        updateField(id, 'color', normalized);
        const hexInput = document.getElementById(`input_${id}_color_hex`);
        const pickerInput = document.getElementById(`input_${id}_color_picker`);
        if (hexInput) hexInput.value = normalized;
        if (pickerInput) pickerInput.value = normalized;
    }

    function updateFieldPosition(id, axis, value) {
        const v = Number.isFinite(value) ? value : parseFloat(value);
        if (!Number.isFinite(v)) return;
        const clamped = Math.max(0, Math.min(100, v));
        updateField(id, axis, clamped);
        const el = document.getElementById(`drag_${id}`);
        if (el) {
            if (axis === 'x') el.style.left = `${clamped}%`;
            if (axis === 'y') el.style.top = `${clamped}%`;
        }
    }

    function bumpField(id, prop, delta) {
        const field = fields.find(f => f.id === id);
        if (!field) return;

        if (prop === 'size') {
            const base = parseInt(field.size, 10);
            const next = Math.max(8, Math.min(200, (Number.isFinite(base) ? base : 36) + delta));
            updateField(id, 'size', next);
            const input = document.getElementById(`input_${id}_size`);
            if (input) input.value = next;
            return;
        }

        if (prop === 'x' || prop === 'y') {
            const base = parseFloat(field[prop]);
            const nextRaw = (Number.isFinite(base) ? base : 50) + delta;
            const next = parseFloat(Math.max(0, Math.min(100, nextRaw)).toFixed(1));
            updateFieldPosition(id, prop, next);
            const input = document.getElementById(`input_${id}_${prop}`);
            if (input) input.value = next;
        }
    }

    function renderFields() {
        const list = document.getElementById('fieldsList');
        list.innerHTML = '';
        
        const container = document.getElementById('certificateContainer');
        // Clear previous draggable elements except image
        const draggables = container.querySelectorAll('.draggable-field');
        draggables.forEach(d => d.remove());

        fields.forEach(field => {
            // Render Control Card
            const card = document.createElement('div');
            card.className = 'field-card';
            card.id = `card_${field.id}`;
            card.onclick = () => focusField(field.id);
            const sampleValue = (field.display_text && String(field.display_text).trim()) ? String(field.display_text) : field.placeholder;
            card.innerHTML = `
                <div class="field-header">
                    <input type="text" class="form-control form-control-sm border-0 bg-transparent p-0 fw-bold" 
                           value="${field.label}" onchange="updateField('${field.id}', 'label', this.value)" onclick="event.stopPropagation()"
                           style="width: 70%; color: var(--primary-neon);">
                    <i class="fas fa-trash-alt remove-field" onclick="event.stopPropagation(); removeField('${field.id}')"></i>
                </div>
                <div class="mb-2">
                    <label class="small text-secondary mb-1">Sample Text</label>
                    <input id="input_${field.id}_text" type="text" class="form-control form-control-sm" value="${sampleValue.replace(/\"/g, '&quot;')}"
                           oninput="updateField('${field.id}', 'display_text', this.value)" onclick="event.stopPropagation()">
                </div>
                <div class="row g-2">
                    <div class="col-6">
                        <label class="small text-secondary mb-1">Size</label>
                        <div class="stepper">
                            <button type="button" class="stepper-btn" onclick="event.stopPropagation(); bumpField('${field.id}', 'size', -1)">−</button>
                            <input id="input_${field.id}_size" type="number" class="stepper-input" value="${field.size}"
                                   oninput="updateField('${field.id}', 'size', parseInt(this.value, 10))" onclick="event.stopPropagation()">
                            <button type="button" class="stepper-btn" onclick="event.stopPropagation(); bumpField('${field.id}', 'size', 1)">+</button>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="small text-secondary mb-1">Color</label>
                        <div class="d-flex align-items-center gap-2">
                            <input id="input_${field.id}_color_picker" type="color" value="${String(field.color).toUpperCase()}" 
                                   class="form-control form-control-sm" style="width: 44px; height: 36px; padding: 0; border-radius: 999px;"
                                   oninput="updateFieldColor('${field.id}', this.value)" onclick="event.stopPropagation()">
                            <input id="input_${field.id}_color_hex" type="text" class="form-control form-control-sm" value="${String(field.color).toUpperCase()}"
                                   oninput="updateFieldColor('${field.id}', this.value)" onclick="event.stopPropagation()">
                        </div>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-6">
                        <label class="small text-secondary mb-1">Horizontal</label>
                        <div class="stepper">
                            <button type="button" class="stepper-btn" onclick="event.stopPropagation(); bumpField('${field.id}', 'x', -0.1)">−</button>
                            <input id="input_${field.id}_x" type="number" step="0.1" class="stepper-input" value="${field.x}"
                                   oninput="updateFieldPosition('${field.id}', 'x', this.value)" onclick="event.stopPropagation()">
                            <button type="button" class="stepper-btn" onclick="event.stopPropagation(); bumpField('${field.id}', 'x', 0.1)">+</button>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="small text-secondary mb-1">Vertical</label>
                        <div class="stepper">
                            <button type="button" class="stepper-btn" onclick="event.stopPropagation(); bumpField('${field.id}', 'y', -0.1)">−</button>
                            <input id="input_${field.id}_y" type="number" step="0.1" class="stepper-input" value="${field.y}"
                                   oninput="updateFieldPosition('${field.id}', 'y', this.value)" onclick="event.stopPropagation()">
                            <button type="button" class="stepper-btn" onclick="event.stopPropagation(); bumpField('${field.id}', 'y', 0.1)">+</button>
                        </div>
                    </div>
                </div>
            `;
            list.appendChild(card);

            // Render Draggable Element
            const dragEl = document.createElement('div');
            dragEl.id = `drag_${field.id}`;
            dragEl.className = 'draggable-field';
            dragEl.innerText = (field.display_text && String(field.display_text).trim()) ? field.display_text : field.placeholder;
            dragEl.style.left = `${field.x}%`;
            dragEl.style.top = `${field.y}%`;
            dragEl.style.fontSize = `${field.size}px`;
            dragEl.style.color = field.color;
            dragEl.style.transform = 'translate(-50%, -50%)';
            
            container.appendChild(dragEl);
            initDraggable(dragEl, field);
        });

        // Update hints
        const labels = fields.map(f => f.label).join(', ');
        const hintEl = document.getElementById('csvColumnsHint');
        if (hintEl) {
            if (csvHeaders.length) {
                hintEl.innerText = `CSV columns: ${csvHeaders.join(', ')} • Fields: ${labels}`;
            } else {
                hintEl.innerText = `Fields: ${labels}`;
            }
        }
    }

    function syncPreviewField(id) {
        const field = fields.find(f => f.id === id);
        const dragEl = document.getElementById(`drag_${id}`);
        if (field && dragEl) {
            dragEl.innerText = (field.display_text && String(field.display_text).trim()) ? field.display_text : field.placeholder;
            dragEl.style.fontSize = `${field.size}px`;
            dragEl.style.color = field.color;
        }
    }

    function focusField(id) {
        document.querySelectorAll('.field-card').forEach(c => c.classList.remove('active'));
        document.querySelectorAll('.draggable-field').forEach(d => d.classList.remove('active'));
        
        document.getElementById(`card_${id}`).classList.add('active');
        document.getElementById(`drag_${id}`).classList.add('active');
    }

    // Draggable Logic
    function initDraggable(el, fieldData) {
        let isDragging = false;
        let startX, startY, initialLeft, initialTop;
        const container = document.getElementById('certificateContainer');

        el.addEventListener('mousedown', (e) => {
            isDragging = true;
            focusField(fieldData.id);
            
            startX = e.clientX;
            startY = e.clientY;
            
            // Get current pixel positions
            initialLeft = el.offsetLeft;
            initialTop = el.offsetTop;
            
            el.style.cursor = 'grabbing';
            e.stopPropagation();
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;

            const dx = e.clientX - startX;
            const dy = e.clientY - startY;

            let newLeft = initialLeft + dx;
            let newTop = initialTop + dy;

            // Constrain
            newLeft = Math.max(0, Math.min(newLeft, container.offsetWidth));
            newTop = Math.max(0, Math.min(newTop, container.offsetHeight));

            el.style.left = `${newLeft}px`;
            el.style.top = `${newTop}px`;
            el.style.transform = 'translate(-50%, -50%)';

            // Update field data percentages
            fieldData.x = parseFloat(((newLeft / container.offsetWidth) * 100).toFixed(1));
            fieldData.y = parseFloat(((newTop / container.offsetHeight) * 100).toFixed(1));

            const xInput = document.getElementById(`input_${fieldData.id}_x`);
            const yInput = document.getElementById(`input_${fieldData.id}_y`);
            if (xInput) xInput.value = fieldData.x;
            if (yInput) yInput.value = fieldData.y;
        });

        document.addEventListener('mouseup', () => {
            if (isDragging) {
                isDragging = false;
                el.style.cursor = 'move';
                // Convert back to percentages for responsiveness
                el.style.left = `${fieldData.x}%`;
                el.style.top = `${fieldData.y}%`;
            }
        });
    }

    // CSV Upload Preview
    document.getElementById('csvInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('csvStatus').innerText = file.name;
            csvReady = false;
            const reader = new FileReader();
            reader.onload = function(e) {
                const text = e.target.result;
                const rows = parseCsvRows(text, 6);
                if (!rows || rows.length < 2) return;

                const headers = rows[0].map(h => String(h).trim()).filter(Boolean);
                const firstRow = rows[1] || [];
                const computedDisplayName = computeDisplayNameFromRow(headers, firstRow);
                csvHeaders = computedDisplayName ? [...headers, 'display_name'] : headers;
                csvFirstRowLower = buildFirstRowLower(headers, firstRow);
                csvReady = true;

                const detectedEl = document.getElementById('csvDetectedColumns');
                if (detectedEl) detectedEl.innerText = `Detected columns: ${headers.join(', ')}`;
                const tbody = document.querySelector('#csvPreviewTable tbody');
                const thead = document.querySelector('#csvPreviewTable thead tr');
                
                tbody.innerHTML = '';
                thead.innerHTML = '';

                // Headers
                headers.forEach(h => {
                    const th = document.createElement('th');
                    th.innerText = h;
                    thead.appendChild(th);
                });

                // Data (5 rows)
                rows.slice(1, 6).forEach(cols => {
                    const tr = document.createElement('tr');
                    cols.forEach(c => {
                        const td = document.createElement('td');
                        td.innerText = String(c ?? '').trim();
                        tr.appendChild(td);
                    });
                    tbody.appendChild(tr);
                });
                
                document.getElementById('csvPreviewContainer').classList.remove('d-none');

                const isDefaultOnly =
                    fields.length === 1 &&
                    fields[0] &&
                    String(fields[0].label).toLowerCase() === 'name' &&
                    fields[0].id === 'field_name';

                if (isDefaultOnly) {
                    const usable = headers.filter(h => h.toLowerCase() !== 'email');
                    if (usable.length) {
                        fields = usable.map((h, index) => {
                            const slug = h.toLowerCase().replace(/[^a-z0-9]+/g, '_').replace(/^_+|_+$/g, '');
                            const y = Math.min(90, 45 + (index * 6));
                            const size = h.toLowerCase() === 'name' ? 36 : 24;
                            const sample = getFirstRowValue(h);
                            return {
                                id: `field_${slug || 'col'}_${index}`,
                                label: h,
                                placeholder: h.toUpperCase(),
                                display_text: (sample && String(sample).trim()) ? String(sample) : h.toUpperCase(),
                                x: 50,
                                y: y,
                                size: size,
                                color: '#000000'
                            };
                        });
                        renderFields();
                        document.getElementById('fieldsJson').value = JSON.stringify(fields);
                    }
                } else {
                    fields = fields.map(f => {
                        const label = f.label;
                        const sample = getFirstRowValue(label);
                        return {
                            ...f,
                            display_text: (sample && String(sample).trim()) ? String(sample) : (f.display_text ?? f.placeholder)
                        };
                    });
                    renderFields();
                    document.getElementById('fieldsJson').value = JSON.stringify(fields);
                }
            }
            reader.readAsText(file);
        }
    });

    // Initial Render
    window.onload = () => {
        renderFields();
    };

</script>

</body>
</html>
