</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/SRGS/assets/js/main.js"></script>

<script>
function toggleSidebar() {
    let sidebar = document.getElementById("sidebar");
    let overlay = document.getElementById("overlay");

    if (window.innerWidth < 768) {
        sidebar.classList.toggle("active");

        if (sidebar.classList.contains("active")) {
            overlay.style.display = "block";
        } else {
            overlay.style.display = "none";
        }

    } else {
        document.body.classList.toggle("sidebar-collapsed");
    }
}

// CLOSE when clicking overlay
document.getElementById("overlay").addEventListener("click", function() {
    document.getElementById("sidebar").classList.remove("active");
    this.style.display = "none";
});

feather.replace();
</script>

<script>
function addItem() {
    let wrapper = document.getElementById('items-wrapper');

    let input = document.createElement('input');
    input.type = 'text';
    input.name = 'items[]';
    input.className = 'form-control mb-2';
    input.placeholder = 'Enter item';

    wrapper.appendChild(input);
}
</script>

<!-- SERVICE -->
<script>
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function() {

        let id = this.dataset.id;
        let title = this.dataset.title;

        document.getElementById('edit-service-id').value = id;
        document.getElementById('edit-title').value = title;

        // FETCH ITEMS
        fetch('get-service-items.php?id=' + id)
        .then(res => res.json())
        .then(data => {

            let wrapper = document.getElementById('edit-items-wrapper');
            wrapper.innerHTML = '';

            data.forEach(item => {
                wrapper.innerHTML += `
                    <input type="text" name="items[]" value="${item.title}" class="form-control mb-2">
                `;
            });

            new bootstrap.Modal(document.getElementById('editServiceModal')).show();
        });

    });
});

function addEditItem() {
    let wrapper = document.getElementById('edit-items-wrapper');

    wrapper.innerHTML += `
        <input type="text" name="items[]" class="form-control mb-2" placeholder="New item">
    `;
}
</script>

<script>
function handleResponsiveSidebar() {
    if (window.innerWidth >= 768 && window.innerWidth <= 1024) {
        document.body.classList.add("sidebar-collapsed");
    } else if (window.innerWidth > 1024) {
        document.body.classList.remove("sidebar-collapsed");
    }
}

window.addEventListener("load", handleResponsiveSidebar);
window.addEventListener("resize", handleResponsiveSidebar);
</script>

</body>
</html>