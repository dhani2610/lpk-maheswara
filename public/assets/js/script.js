document.addEventListener("DOMContentLoaded", function() {
    // Toggle Sidebar
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebar = document.getElementById("sidebar");
    
    sidebarToggle.addEventListener("click", function() {
        if(window.innerWidth <= 768) {
            sidebar.classList.toggle("show");
        } else {
            sidebar.classList.toggle("collapsed");
        }
    });

    // Inisialisasi Summernote (Untuk konten Text Editor)
    if($('.summernote').length) {
        $('.summernote').summernote({ height: 200, placeholder: 'Tulis deskripsi lengkap di sini...' });
    }

    // Dynamic Input (Untuk Checklist About)
    const btnAddChecklist = document.getElementById('addChecklist');
    const checklistContainer = document.getElementById('checklistContainer');
    if(btnAddChecklist) {
        btnAddChecklist.addEventListener('click', function() {
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-2';
            inputGroup.innerHTML = `
                <input type="text" class="form-control" name="unggulan[]" placeholder="Keunggulan LPK...">
                <button class="btn btn-outline-danger btn-remove-checklist" type="button"><i class="fa-solid fa-trash"></i></button>
            `;
            checklistContainer.appendChild(inputGroup);
        });

        checklistContainer.addEventListener('click', function(e) {
            if(e.target.closest('.btn-remove-checklist')) {
                e.target.closest('.input-group').remove();
            }
        });
    }
});