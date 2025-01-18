@extends('layouts.header')

@section('content')
<style>
    body {
        color: #fff !important;
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #2c3e50;
        border-radius: 10px;
    }

    h2 {
        text-align: center;
        color: #ecf0f1;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    label {
        font-size: 16px;
        font-weight: bold;
        color: #ecf0f1;
    }

    input, select, textarea {
        padding: 10px;
        font-size: 14px;
        border: 1px solid #bdc3c7;
        border-radius: 5px;
        background-color: #34495e;
        color: #ecf0f1;
        width: 100%;
    }

    input[type="file"] {
        padding: 0;
    }

    .doc-preview img {
        width: 150px;
        margin-top: 10px;
    }

    .doc-preview a {
        color: #3498db;
        text-decoration: none;
        margin-top: 10px;
        display: block;
    }

    .doc-preview a:hover {
        text-decoration: underline;
    }

    button {
        padding: 10px 20px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
        margin-top: 20px;
    }

    button:hover {
        background-color: #2980b9;
    }

    /* Styling for print */
    @media print {
        body {
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        #export-area {
            margin: auto;
            width: 100%;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .no-print {
            display: none;
        }
    }
</style>

<div class="container">
    <h2>Update Profile</h2>
    <form action="{{ route('partner.updateProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Name (Read-Only) -->
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $profile->name ?? '' }}" readonly>
        </div>

        <!-- Email (Read-Only) -->
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $profile->email_id ?? '' }}" readonly>
        </div>

        <!-- Mobile Number -->
        <div>
            <label for="mobile_no">Mobile Number:</label>
            <input type="text" id="mobile_no" name="mobile_no" value="{{ $profile->mobile_no ?? '' }}">
        </div>

        <!-- Date of Birth -->
        <div>
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="{{ $profile->dob ?? '' }}">
        </div>

        <!-- Marital Status -->
        <div>
            <label for="marital_status">Marital Status:</label>
            <select id="marital_status" name="marital_status">
                <option value="Single" {{ $profile->marital_status === 'Single' ? 'selected' : '' }}>Single</option>
                <option value="Married" {{ $profile->marital_status === 'Married' ? 'selected' : '' }}>Married</option>
            </select>
        </div>

        <!-- Gender -->
        <div>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="Male" {{ $profile->gender === 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $profile->gender === 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <!-- Address -->
        <div>
            <label for="residence_address">Address:</label>
            <textarea id="residence_address" name="residence_address">{{ $profile->residence_address ?? '' }}</textarea>
        </div>

        <!-- Documents -->
        <div>
            <label for="rera_doc">RERA Document:</label>
            @if (!empty($profile->rera_doc))
                <a href="{{ asset($profile->rera_doc) }}" target="_blank">View Uploaded Document</a>
            @endif
            <input type="file" id="rera_doc" name="rera_doc" accept=".jpg, .jpeg, .png, .pdf" onchange="previewFile('rera_preview', this)">
            <div id="rera_preview" class="doc-preview"></div>
        </div>

        <div>
            <label for="licence_doc">Licence Document:</label>
            @if (!empty($profile->licence_doc))
                <a href="{{ asset($profile->licence_doc) }}" target="_blank">View Uploaded Document</a>
            @endif
            <input type="file" id="licence_doc" name="licence_doc" accept=".jpg, .jpeg, .png, .pdf" onchange="previewFile('licence_preview', this)">
            <div id="licence_preview" class="doc-preview"></div>
        </div>

        <div>
            <label for="address_proof">Address Proof:</label>
            @if (!empty($profile->address_proof))
                <a href="{{ asset($profile->address_proof) }}" target="_blank">View Uploaded Document</a>
            @endif
            <input type="file" id="address_proof" name="address_proof" accept=".jpg, .jpeg, .png, .pdf" onchange="previewFile('address_preview', this)">
            <div id="address_preview" class="doc-preview"></div>
        </div>

        <!-- Submit Button -->
        <button type="submit">Update Profile</button>
    </form>
</div>

<script>
    function previewFile(previewId, input) {
        const previewDiv = document.getElementById(previewId);
        const file = input.files[0];
        const reader = new FileReader();

        if (file) {
            const fileType = file.type;

            // Clear the previous preview
            previewDiv.innerHTML = '';

            // For image files (jpg, png, etc.)
            if (fileType.startsWith('image/')) {
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    previewDiv.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
            // For PDF files
            else if (fileType === 'application/pdf') {
                const link = document.createElement('a');
                link.href = URL.createObjectURL(file);
                link.target = '_blank';
                link.textContent = 'Preview PDF';
                previewDiv.appendChild(link);
            } else {
                previewDiv.textContent = 'Preview not available for this file type.';
            }
        }
    }
</script>
@endsection
