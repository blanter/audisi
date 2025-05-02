function renderWorks() {
    const level = document.getElementById("level").value;
    const workSelect = document.getElementById("work");
    workSelect.innerHTML = `<option value="">-- Pilih Karya --</option>`;

    if (assessmentData[level]) {
        Object.keys(assessmentData[level]).forEach(work => {
            const opt = document.createElement("option");
            opt.value = work;
            opt.textContent = work;
            workSelect.appendChild(opt);
        });
    }

    document.getElementById("assessment-area").innerHTML = '';
}

function renderAssessment() {
    const level = document.getElementById("level").value;
    const work = document.getElementById("work").value;
    const container = document.getElementById("assessment-area");
    container.innerHTML = '';

    if (assessmentData[level] && assessmentData[level][work]) {
        assessmentData[level][work].forEach((section, i) => {
            const sectionDiv = document.createElement("div");
            sectionDiv.className = "border p-3 mb-3 rounded-xl";
            sectionDiv.innerHTML = `<h5>${section.title}</h5>`;

            section.options.forEach((opt, j) => {
                const inputId = `penilaian_${i}_${j}`;
                const inputName = section.type === 'radio' ? `group_${i}` : `penilaian_${i}_${j}`;

                const inputHtml = `
                    <div class="form-check">
                        <input class="form-check-input"
                            type="${section.type}"
                            name="${inputName}"
                            value="${opt.value}"
                            id="${inputId}"
                            data-title="${section.title}"
                            data-label="${opt.label}">
                        <label class="form-check-label" for="${inputId}">
                            ${opt.label} (${opt.value} poin)
                        </label>
                    </div>
                `;
                sectionDiv.innerHTML += inputHtml;
            });

            container.appendChild(sectionDiv);
        });
    }
}

// Submit Handler
document.getElementById("submit-btn").addEventListener("click", function (e) {
    e.preventDefault();

    const penilaian = [];

    // Loop semua input yang dipilih (checkbox dan radio)
    document.querySelectorAll("input.form-check-input:checked").forEach(input => {
        const title = input.dataset.title;
        const label = input.dataset.label;
        const score = parseInt(input.value);

        if (title && label && !isNaN(score)) {
            penilaian.push({ title, label, score });
        }
    });

    // Masukkan data ke hidden input sebelum submit
    document.getElementById("penilaian-hidden").value = JSON.stringify(penilaian);

    // Submit form
    document.getElementById("form-penilaian").submit();
});