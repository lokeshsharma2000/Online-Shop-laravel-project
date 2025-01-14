<style>
    /* Modal backdrop */
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5);
    }

    /* Modal dialog - center the modal */
    .modal-dialog {
        display: flex;
        justify-content: center;
        align-items: center;
        max-width: 600px;
        margin: 0;
        height: 100%;
    }

    /* Modal content */
    .modal-content {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Slight shadow to lift modal */
        background-color: #fff;
        padding: 20px;
        margin-left: 500px;

    }

    /* Modal Header */
    .modal-header {
        border-bottom: 1px solid #ddd;
        padding: 0;
        margin-bottom: 15px;
    }

    .modal-title {
        font-size: 26px;
        font-weight: 700;
        color: #333;
        text-align: center;
    }

    .btn-close {
        border: none;
        background: transparent;
        font-size: 24px;
        color: #ccc;
        transition: all 0.3s ease;
    }

    .btn-close:hover {
        color: #999;
    }

    /* Modal body */
    .modal-body {
        padding: 10px;
    }

    /* Form Labels */
    .mb-3 {
        margin-bottom: 20px;
    }

    .form-label {
        font-size: 16px;
        font-weight: 600;
        color: #555;
        margin-bottom: 8px;
    }

    /* Inputs and Selects */
    .form-control {
        font-size: 14px;
        padding: 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
    }

    .form-select {
        font-size: 14px;
        padding: 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease-in-out;
    }

    .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
    }

    /* Modal Footer */
    .modal-footer {
        padding: 15px 0;
        border-top: 1px solid #ddd;
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    /* Buttons */
    .btn {
        font-size: 16px;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease-in-out;
    }

    .btnGray {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btnGray:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
    }

    .btnRed {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btnRed:hover {
        background-color: #c82333;
        transform: translateY(-2px);
    }

    /* File input */
    .form-control[type="file"] {
        padding: 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .modal-dialog {
            max-width: 90%;
            margin-top: 20px;
        }

        .modal-title {
            font-size: 22px;
        }
        #addModal3{
            margin-left: 250px;

        }
    }
</style>

<!-- Modal -->
<div class="modal fade" id="addModal3" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit SubCategory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('admin.subcategory.update',['id' => $subcategory->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Image Upload</label>
                        <input class="form-control" type="file" name="image" id="formFile" required>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" id="title" class="form-control" name="title" placeholder="Enter Title" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea id="description" name="description" rows="4" cols="50" placeholder="Enter description here"></textarea>                   
                     </div>
                    
                    <div class="mb-3">
    <label class="form-label" for="categoryID">Category</label>
    <select id="categoryID" class="form-control" name="categoryID" required>
        <option value="" disabled selected>Choose a Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
        @endforeach
    </select>
</div>
                    

                    <div class="modal-footer">
                    <button type="button" class="btn btnGray" onclick="history.back()">Cancel</button>
                        <button type="submit" class="btn btnRed">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
