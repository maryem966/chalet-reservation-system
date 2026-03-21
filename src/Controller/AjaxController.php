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
                'value' => $reservation->date_reservation,
                'class' => 'form-input'
            ]) ?>
        </div>
    </div>
</div>

<br><br>

<!-- Box 2: Reservation Details -->
<div class="user-form-box">
    <div class="form-box-header">
        <h2 class="form-box-title">Reservation Details</h2>
        <button type="button" class="form-submit-btn" onclick="addReservationDetail()"> Add</button>
    </div>

    <table id="details-table" style="width: 100%; margin-top: 20px;">
        <thead>
            <tr>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Chalet</th>
                <th>Tariff</th>
                <th>Price</th>
                <th>حالة Payment</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody id="details-body">
            <tr>
                <td><input type="date" name="reservationsdetails[0][date_debut]" class="form-input"></td>
                <td><input type="date" name="reservationsdetails[0][date_fin]" class="form-input"></td>
                <td>
                    <select name="reservationsdetails[0][chalet_id]" class="form-input chalet-select">
                        <option value="">تحميل...</option>
                    </select>
                </td>
                <td><?= $this->Form->select('reservationsdetails[0][tarif_id]', $tarifs, ['empty' => 'Select', 'class' => 'form-input']) ?></td>
                <td><input type="number" name="reservationsdetails[0][prix]" class="form-input"></td>
                <td>
                    <select name="reservationsdetails[0][statut]" class="form-input">
                        <option value="">Select</option>
                        <option value="en_attente">Pending</option>
                        <option value="confirme">Confirmed</option>
                        <option value="annule">Cancelled</option>
                    </select>
                </td>
                <td><button type="button" onclick="removeRow(this)" class="form-submit-btn" style="background-color: #dc3545;">❌</button></td>
            </tr>
        </tbody>
    </table>

    <div class="form-actions" style="margin-top: 30px;">
        <button type="submit" class="form-submit-btn">Save Reservation</button>
        <a href="<?= $this->Url->build(['controller' => 'Reservations', 'action' => 'reservationstable']) ?>" class="btn-back">Back</a>
    </div>
</div>

<?= $this->Form->end() ?>

<script>
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
            <td><input type="date" name="reservationsdetails[${detailIndex}][date_debut]" class="form-input"></td>
            <td><input type="date" name="reservationsdetails[${detailIndex}][date_fin]" class="form-input"></td>
            <td><select name="reservationsdetails[${detailIndex}][chalet_id]" class="form-input chalet-select"><option value="">تحميل...</option></select></td>
            <td>${buildSelect(`reservationsdetails[${detailIndex}][tarif_id]`, tarifsOptions)}</td>
            <td><input type="number" name="reservationsdetails[${detailIndex}][prix]" class="form-input"></td>
            <td>
                <select name="reservationsdetails[${detailIndex}][statut]" class="form-input">
                    <option value="">Select</option>
                    <option value="en_attente">Pending</option>
                    <option value="confirme">Confirmed</option>
                    <option value="annule">Cancelled</option>
                </select>
            </td>
            <td><button type="button" onclick="removeRow(this)" class="form-submit-btn" style="background-color:#dc3545;">❌</button></td>
        `;

        tbody.appendChild(row);

        const chaletSelect = row.querySelector('select[name*="[chalet_id]"]');
        fetchAvailableChalets(chaletSelect);

        detailIndex++;
    }

    function removeRow(btn) {
        btn.closest("tr").remove();
    }
public function availableChalets()
{
    $this->request->allowMethod(['get']);
    $this->loadModel('Chalets');

    // Replace this with your availability logic if needed
    $chalets = $this->Chalets->find('list')->toArray();

    $this->set([
        'availableChalets' => $chalets,
        '_serialize' => ['availableChalets']
    ]);
}


    window.addEventListener('DOMContentLoaded', function () {
        const firstChaletSelect = document.querySelector('select[name="reservationsdetails[0][chalet_id]"]');
        if (firstChaletSelect) {
            fetchAvailableChalets(firstChaletSelect);
        }
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
