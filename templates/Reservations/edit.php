<div class="user-form-box">
    <h2 class="form-box-title">Client Information</h2>

    <?= $this->Form->create($reservation, ['class' => 'styled-user-form']) ?>

    <div class="form-row form-row-dual">
        <div class="form-col">
            <?= $this->Form->control('client_id', [
                'label' => 'Select Client',
                'options' => $clients,
                'empty' => '--- Select Client ---',
                'class' => 'form-input',
                'templates' => [
                    'inputContainer' => '<div class="input-container">{{content}}</div>'
                ]
            ]) ?>
        </div>

        <div class="form-col">
            <?= $this->Form->control('date_reservation', [
                'type' => 'datetime-local',
                'label' => 'Reservation Date',
                'value' => $reservation->date_reservation ?? '',
                'class' => 'form-input'
            ]) ?>

        </div>
    </div>
</div>

<br><br>


<div class="user-form-box">
    <div class="form-box-header">
        <h2 class="form-box-title">Reservation Details</h2>
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
                <td><input type="date" name="reservationsdetails[0][date_debut]" class="form-input"></td>
                <td><input type="date" name="reservationsdetails[0][date_fin]" class="form-input"></td>
                <td><?= $this->Form->select('reservationsdetails[0][chalet_id]', $chalets, ['empty' => 'Select', 'class' => 'form-input']) ?></td>
                <td>
                    <input type="text" data-name="prix_text" class="form-input" readonly>
                    <input type="hidden" name="reservationsdetails[0][tarif_id]">
                </td>
                <td><input type="text" name="reservationsdetails[0][prix]" class="form-input" readonly></td>
                <td class="text-center"><button type="button" onclick="removeRow(this)" class="form-submit-btn" style="background-color: #dc3545;">❌</button></td>
            </tr>
        </tbody>
    </table>

    <div class="form-actions" style="margin-top: 30px;">
        <button type="submit" class="form-submit-btn">Save Reservation</button>
        <a href="<?= $this->Url->build(['action' => 'reservationstable']) ?>" class="btn-back">Back</a>
    </div>
</div>

<?= $this->Form->end() ?>
<script>
const chaletsOptions = <?= json_encode($chalets) ?>;
const chaletDefaultPrices = <?= json_encode($chaletPrices) ?>;
const tarifsOptions = <?= json_encode($tarifs) ?>;

let detailIndex = 1;

function buildSelect(name, options, emptyLabel = 'Select') {
    let html = <select name="${name}" class="form-input">;
    html += <option value="">${emptyLabel}</option>;
    for (const [value, label] of Object.entries(options)) {
        html += <option value="${value}">${label}</option>;
    }
    html += </select>;
    return html;
}

function addReservationDetail() {
    const tbody = document.getElementById("details-body");
    const row = document.createElement("tr");

    row.innerHTML = `
        <td><input type="date" name="reservationsdetails[${detailIndex}][date_debut]" class="form-input"></td>
        <td><input type="date" name="reservationsdetails[${detailIndex}][date_fin]" class="form-input"></td>
        <td>${buildSelect(`reservationsdetails[${detailIndex}][chalet_id]`, chaletsOptions)}</td>
        <td>
            <input type="text" data-name="prix_text" class="form-input" readonly>
            <input type="hidden" name="reservationsdetails[${detailIndex}][tarif_id]">
        </td>
        <td><input type="text" name="reservationsdetails[${detailIndex}][prix]" class="form-input" readonly></td>
        <td><button type="button" onclick="removeRow(this)" class="form-submit-btn" style="background-color:#dc3545;">❌</button></td>
    `;
    tbody.appendChild(row);
    bindPriceAutoFill(row);
    updatePriceForRow(row);
    detailIndex++;
}

function removeRow(btn) {
    btn.closest("tr").remove();
}

function openClientModal() {
    document.getElementById('clientModal').style.display = 'flex';
}

function closeClientModal() {
    const modal = document.getElementById('clientModal');
    const form = document.getElementById('addClientForm');
    if (modal) modal.style.display = 'none';
    if (form) form.reset();
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
                firstTarifId = matchedTarif.id || "";
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
}

function bindPriceAutoFill(row) {
    const dateInputs = row.querySelectorAll('input[type="date"]');
    const chaletSelect = row.querySelector('select');
    dateInputs.forEach(input => input.addEventListener('change', () => updatePriceForRow(row)));
    chaletSelect.addEventListener('change', () => updatePriceForRow(row));
}



    document.querySelectorAll('#details-body tr').forEach(row => {
        bindPriceAutoFill(row);
        updatePriceForRow(row);
    });
</script>

<style>
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
    gap: 20px;
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
  padding: 8px 10px;
  vertical-align: middle;
}
#details-table select,
#details-table input {
  width: 100%;
  box-sizing: border-box;
}
</style>