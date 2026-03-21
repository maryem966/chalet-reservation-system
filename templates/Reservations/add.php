<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 */
?>
<?= $this->Form->create($reservation, ['class' => 'styled-user-form']) ?>

<div class="user-form-box">
    <div class="form-box-header">
        <h2 class="form-box-title">Client Information</h2>
        <button onclick="openClientModal()" class="form-submit-btn">+ New Client</button>
    </div>

<div id="clientModal" class="modal-overlay" style="display: none;">
    <div class="modal-box">
        <span onclick="closeClientModal()" class="close">&times;</span>
        <h3 class="modal-title">Add New Client</h3>
        <form id="addClientForm">
            <div class="form-row">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-input" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="birth_date" class="form-input" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-input" placeholder="Email">
                </div>
                <div class="form-group">
                    <label>WhatsApp Number</label>
                    <input type="text" name="whatsapp" class="form-input" placeholder="WhatsApp Number">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" class="form-input" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <label>Passport Number</label>
                    <input type="text" name="passport_number" class="form-input" placeholder="Passport Number">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Nationality</label>
                    <input type="text" name="nationality" class="form-input" placeholder="Nationality">
                </div>
                <div class="form-group">
                    <label> </label> <!-- Champ vide pour alignement -->
                    <input type="text" class="form-input" disabled style="background: transparent; border: none;">
                </div>
            </div>

            <div class="modal-actions">
                <button type="submit" class="form-submit-btn">Save</button>
                <button type="button" class="btn-back" onclick="closeClientModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>



    <?= $this->Form->create($reservation, ['class' => 'styled-user-form']) ?>

    <div class="form-row form-row-dual">
        <div class="form-col">
            <?= $this->Form->control('client_id', [
                'label' => 'Select Client',
                'options' => $clients,
                'empty' => '--- Select Client ---',
                'class' => 'form-input',
                'templates' => ['inputContainer' => '<div class="input-container">{{content}}</div>'],
                'id' => 'client-id'
            ]) ?>
        </div>

        <div class="form-col">
            <?= $this->Form->control('date_reservation', [
                'type' => 'datetime-local',
                'label' => 'Reservation Date',
                'value' => $reservation->date_reservation,
                'class' => 'form-input'
            ]) ?>
        </div>
    </div>
</div>

<br><br>

<div class="user-form-box">
<div class="form-box-header" style="flex-wrap: wrap; gap: 10px;">
    <div class="form-box-title" style="font-size: 22px;">
        Reservation Details
        <span style="font-size: 18px; color: #444; margin-right: 15px;">
            (Reservation Number: <?= h($reservation->numero) ?>)
        </span>
    </div>

    <button type="button" class="form-submit-btn" onclick="addReservationDetail()">Add</button>
</div>


    <table id="details-table" style="width: 100%; margin-top: 20px;">
        <thead>
            <tr>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Chalet</th>
                <th>Price / ليلة</th>
                <th>Total</th>
                <th class="text-center">Delete</th>
            </tr>
        </thead>
        <tbody id="details-body">
            <tr>
                <td><input type="date" name="Reservationsdetails[0][date_debut]" class="form-input"></td>
                <td><input type="date" name="Reservationsdetails[0][date_fin]" class="form-input"></td>
                <td><?= $this->Form->select('Reservationsdetails[0][chalet_id]', $chalets, ['empty' => 'Select', 'class' => 'form-input']) ?></td>
                <td>
                    <input type="text" data-name="prix_text" class="form-input" readonly>
                    <input type="hidden" name="Reservationsdetails[0][tarif_id]">
                </td>
                <td><input type="text" name="Reservationsdetails[0][prix]" class="form-input" readonly></td>
                <td class="text-center"><button type="button" onclick="removeRow(this)" class="form-submit-btn" style="background-color: #dc3545;">❌</button></td>
            </tr>
        </tbody>
    </table>

<div style="text-align: right; margin-top: 20px; font-weight: bold;">
    <label for="overall-total">Overall Total:</label>
    <input type="text" id="overall-total" name="overall_total" value="0.00" readonly style="border: none; background: transparent; font-weight: bold; text-align: right;">
</div>


    <div class="form-actions" style="margin-top: 30px;">
        <button type="submit" class="form-submit-btn">Save Reservation</button>
        <a href="<?= $this->Url->build(['action' => 'reservationstable']) ?>" class="btn-back">Back</a>
    </div>

    <?= $this->Form->end() ?>

</div>


<!-- JS script -->
<script>
const chaletsOptions = <?= json_encode($chalets) ?>;
const chaletDefaultPrices = <?= json_encode($chaletPrices) ?>;
const tarifsOptions = <?= json_encode($tarifs) ?>;

let detailIndex = 1;

function buildSelect(name, options, emptyLabel = 'Select') {
    let html = `<select name="${name}" class="form-input">`;
    html += `<option value="">${emptyLabel}</option>`;
    for (const [value, label] of Object.entries(options)) {
        html += `<option value="${value}">${label}</option>`;
    }
    html += `</select>`;
    return html;
}

function addReservationDetail() {
    const tbody = document.getElementById("details-body");
    const row = document.createElement("tr");

    row.innerHTML = `
        <td><input type="date" name="Reservationsdetails[${detailIndex}][date_debut]" class="form-input"></td>
        <td><input type="date" name="Reservationsdetails[${detailIndex}][date_fin]" class="form-input"></td>
        <td>${buildSelect(`Reservationsdetails[${detailIndex}][chalet_id]`, chaletsOptions)}</td>
        <td>
            <input type="text" data-name="prix_text" class="form-input" readonly>
            <input type="hidden" name="Reservationsdetails[${detailIndex}][tarif_id]">
        </td>
        <td><input type="text" name="Reservationsdetails[${detailIndex}][prix]" class="form-input" readonly></td>
        <td><button type="button" onclick="removeRow(this)" class="form-submit-btn" style="background-color:#dc3545;">❌</button></td>
    `;
    tbody.appendChild(row);
    bindPriceAutoFill(row);
    updatePriceForRow(row);
    detailIndex++;
}

function removeRow(btn) {
    btn.closest("tr").remove();
    updateGrandTotal();
}

function openClientModal() {
    document.getElementById('clientModal').style.display = 'flex';
}

function closeClientModal() {
    document.getElementById('clientModal').style.display = 'none';
    document.getElementById('addClientForm').reset();
}

function updatePriceForRow(row) {
    const dateDebutInput = row.querySelector('[name$="[date_debut]"]');
    const dateFinInput = row.querySelector('[name$="[date_fin]"]');
    const chaletSelect = row.querySelector('select[name$="[chalet_id]"]');
    const prixInput = row.querySelector('input[data-name="prix_text"]');
    const totalInput = row.querySelector('input[name$="[prix]"]');
    const tarifIdInput = row.querySelector('input[name$="[tarif_id]"]');

    const dateDebut = dateDebutInput.value;
    const dateFin = dateFinInput.value;
    const chaletId = chaletSelect.value;

    if (dateDebut && dateFin && chaletId) {
        const start = new Date(dateDebut);
        const end = new Date(dateFin);
        const oneDay = 24 * 60 * 60 * 1000;
        let totalPrice = 0;
        let dayCount = 1;
        let priceListText = "";
        let firstTarifId = "";

        let loopEnd = start.getTime() === end.getTime() ? new Date(end.getTime() + oneDay) : end;

        for (let d = new Date(start); d < loopEnd; d = new Date(d.getTime() + oneDay)) {
            const currentDateStr = d.toISOString().split('T')[0];
            const matchedTarif = tarifsOptions.find(tarif =>
                String(tarif.chalet_id) === chaletId &&
                currentDateStr >= tarif.date_debut &&
                currentDateStr <= tarif.date_fin
            );

            if (matchedTarif && !firstTarifId) {
                firstTarifId = matchedTarif.id || ""; // ensure ID if present
            }

            const priceForDay = matchedTarif ? parseFloat(matchedTarif.prix) : parseFloat(chaletDefaultPrices[chaletId] || 0);
            totalPrice += priceForDay;

            priceListText += `${dayCount} : ${priceForDay}`;
            if (new Date(d.getTime() + oneDay) < loopEnd) {
                priceListText += ", ";
            }
            dayCount++;
        }

        prixInput.value = priceListText;
        totalInput.value = totalPrice.toFixed(2);
        if (tarifIdInput) tarifIdInput.value = firstTarifId;
    } else {
        prixInput.value = '';
        totalInput.value = '';
        if (tarifIdInput) tarifIdInput.value = '';
    }

    updateGrandTotal();
}

function bindPriceAutoFill(row) {
    const dateInputs = row.querySelectorAll('input[type="date"]');
    const chaletSelect = row.querySelector('select');

    dateInputs.forEach(input => input.addEventListener('change', () => updatePriceForRow(row)));
    chaletSelect.addEventListener('change', () => updatePriceForRow(row));
}

function updateGrandTotal() {
    const totalInputs = document.querySelectorAll('input[name$="[prix]"]');
    let overallTotal = 0;
    totalInputs.forEach(input => {
        const value = parseFloat(input.value);
        if (!isNaN(value)) {
            overallTotal += value;
        }
    });
document.getElementById("overall-total").value = overallTotal.toFixed(2);
}

document.addEventListener('DOMContentLoaded', () => {
    const addForm = document.getElementById('addClientForm');
    if (addForm) {
        addForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            try {
                const response = await fetch('maryem/clients/ajaxAdd', {
                    method: 'POST',
                    body: formData,
                    headers: { 'Accept': 'application/json' }
                });

                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                const result = await response.json();

                if (result.success) {
                    closeClientModal();
                    const select = document.getElementById('client-id');
                    const option = document.createElement('option');
                    option.value = result.client.id;
                    option.textContent = result.client.name;
                    option.selected = true;
                    select.appendChild(option);
                    alert('✅ تمت Add Client بنجاح');
                } else {
                    alert('❌ حدث خطأ أثناء Add Client');
                }
            } catch (error) {
                console.error('Erreur AJAX:', error);
                alert('❌ حدث خطأ في اNoتصال بالخادم');
            }
        });
    }

    // Initial bind
    const allRows = document.querySelectorAll('#details-body tr');
    allRows.forEach(row => {
        bindPriceAutoFill(row);
        updatePriceForRow(row);
    });
});


const url = `/reglements/adding?client_id=${encodeURIComponent(clientId)}&montant=${encodeURIComponent(total)}`;
window.location.href = url;

</script>
<style>
.form-row {
    display: flex;
    gap: 50px; /* <-- Espace horizontal entre les deux champs */
    margin-bottom: 15px;
}

.form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
    margin-left: 20px;
}
.form-group:first-child {
    margin-left: 0;
}


.form-row {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 15px;
}

.form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.form-input {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-top: 5px;
    font-size: 14px;
}

.user-form-box {
    max-width: 1100px;
    margin: auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.form-row-dual {
    display: flex;
    gap:50px;
    flex-wrap: wrap;
}
.form-col {
    flex: 1;
    min-width: 250px;
}
.form-box-title {
    margin-bottom: 20px;
    text-align: right;
    font-size: 24px;
    font-weight: bold;
    color: #444;
}
.form-box-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.form-box-header .form-box-title {
    margin: 0;
}
#details-table td {
    padding: 8px 20px;
    vertical-align: middle;
}
#details-table select,
#details-table input {
    width: 100%;
    box-sizing: border-box;
}
th {
    text-align: right;
    padding-right: 30px;
    padding-left: 5px;
}
.small-btn {
    background-color: #f26d9e;
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: bold;
    font-size: 18px;
    cursor: pointer;
    padding: 4px 10px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s ease;
}
.small-btn:hover {
    background-color: #e75c91;
}
.modal-overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999;
}
.modal-content {
    background-color: #fff;
    padding: 25px;
    border-radius: 10px;
    width: 400px;
    max-width: 90%;
    text-align: right;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
}
.modal-content h3 {
    margin-bottom: 15px;
    font-size: 20px;
    color: #333;
}
.modal-actions {
    margin-top: 20px;
    display: flex;
    justify-content: flex-start;
    gap: 10px;
}
.modal {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.6);
  z-index: 1000;
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-content {
  background: #fff;
  padding: 20px;
  width: 400px;
  border-radius: 10px;
  position: relative;
}

.close {
  position: absolute;
  top: 10px; right: 15px;
  cursor: pointer;
  font-size: 20px;
}
.modal-overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999;
}

.modal-box {
    background-color: #fff;
    padding: 30px;
    border-radius: 12px;
    width: 450px;
    max-width: 95%;
    box-shadow: 0 0 20px rgba(0,0,0,0.25);
    position: relative;
    direction: rtl;
}

.modal-title {
    font-size: 22px;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

.modal-box input {
    margin-bottom: 12px;
}

.close {
    position: absolute;
    top: 12px;
    left: 15px;
    font-size: 22px;
    color: #666;
    cursor: pointer;
}

.modal-actions {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-top: 20px;
}

    #overall-total {
        border: 2px solid #ccc;
        background-color: #ec8181ff;
        font-weight: bold;
        text-align: right;
        padding: 6px 10px;
        border-radius: 5px;
        width: 150px;
        font-size: 16px;
        color: #333;
    }

</style> 


