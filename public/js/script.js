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

                const baseInput = `
                    <div class="form-check mb-2">
                        <input class="form-check-input"
                            type="${section.type}"
                            name="${inputName}"
                            value="${opt.value}"
                            id="${inputId}"
                            data-title="${section.title}"
                            data-label="${opt.label}">
                        <label class="form-check-label" for="${inputId}">
                            ${opt.label} (default: ${opt.value} poin)
                        </label>
                    </div>
                `;

                let rangeInput = '';
                //if (section.type === 'radio') {
                    rangeInput = `
                        <div class="mb-3 ms-4">
                            <input type="range"
                                class="form-range"
                                min="0"
                                max="50"
                                step="1"
                                id="range_${inputId}"
                                data-for="${inputId}"
                                value="${opt.value}">
                            <span class="range-value" id="range_value_${inputId}">${opt.value}</span> poin
                        </div>
                    `;
                //}

                sectionDiv.innerHTML += baseInput + rangeInput;
            });

            container.appendChild(sectionDiv);
        });

        // Tambahkan event listener untuk update nilai slider saat dipilih
        document.querySelectorAll("input[type=radio]").forEach(radio => {
            radio.addEventListener("change", () => {
                // Matikan semua slider terkait radio group lainnya
                const groupName = radio.name;
                document.querySelectorAll(`input[name='${groupName}']`).forEach(input => {
                    const slider = document.getElementById(`range_${input.id}`);
                    if (slider) {
                        slider.disabled = input !== radio;
                    }
                });
            });
        });

        // Tampilkan nilai slider saat digeser
        document.querySelectorAll(".form-range").forEach(slider => {
            const targetSpan = document.getElementById(`range_value_${slider.id.split("range_")[1]}`);
            slider.addEventListener("input", () => {
                targetSpan.textContent = slider.value;
            });
        });
    }

    // Panggil saat ada perubahan pilihan input
    document.querySelectorAll("input.form-check-input").forEach(input => {
        input.addEventListener("change", updateTotalNilai);
    });

    // Panggil saat slider digeser
    document.querySelectorAll(".form-range").forEach(slider => {
        slider.addEventListener("input", updateTotalNilai);
    });
}

// Update Realtime
let initialTotal = parseInt(document.querySelector(".datanilai")?.textContent || "0");
function updateTotalNilai() {
    let total = 0;
    let overLimit = false;

    document.querySelectorAll("input.form-check-input:checked").forEach(input => {
        const slider = document.getElementById(`range_${input.id}`);
        if (slider) {
            const value = parseInt(slider.value) || 0;
            if (total + value + initialTotal > 100) {
                slider.value = 0;
                document.getElementById(`range_value_${input.id}`).textContent = '0';
                overLimit = true;
            } else {
                total += value;
            }
        }
    });

    const totalDisplayed = total + initialTotal;
    document.querySelector(".total_nilai").textContent = `Nilai: ${totalDisplayed}/100`;

    if (overLimit) {
        alert("Total nilai tidak boleh lebih dari 100!");
    }
}

// Submit Handler
document.getElementById("submit-btn").addEventListener("click", function (e) {
    e.preventDefault();

    const penilaian = [];

    document.querySelectorAll("input.form-check-input:checked").forEach(input => {
        const title = input.dataset.title;
        const label = input.dataset.label;

        // Jika ada slider terhubung (khusus radio)
        const rangeSlider = document.getElementById(`range_${input.id}`);
        const score = rangeSlider ? parseInt(rangeSlider.value) : parseInt(input.value);

        if (title && label && !isNaN(score)) {
            penilaian.push({ title, label, score });
        }
    });

    document.getElementById("penilaian-hidden").value = JSON.stringify(penilaian);
    const total = penilaian.reduce((sum, item) => sum + item.score, 0);
    if (total > 100) {
        alert("Total nilai melebihi batas maksimum 100 poin.");
        return;
    }
    document.getElementById("form-penilaian").submit();
});
