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
                const name = `penilaian[${i}_${j}]`;
                const inputName = section.type === 'radio' ? `penilaian[${i}][score]` : `${name}[score]`;
                const inputHtml = `
                    <div class="form-check">
                        <input class="form-check-input"
                            type="${section.type}"
                            name="${inputName}"
                            value="${opt.value}"
                            id="${name}_${j}" required>
                        <label class="form-check-label" for="${name}_${j}">
                            ${opt.label} (${opt.value} poin)
                        </label>
                    </div>
                `;
                sectionDiv.innerHTML += inputHtml;
            });
            const hiddenLabel = `
                <input type="hidden"
                    name="penilaian[${i}][label]"
                    value="${section.title}">
            `;
            sectionDiv.innerHTML += hiddenLabel;
            container.appendChild(sectionDiv);
        });
    }
}