<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">
        <section class="panel">
            <div class="panel-header"><div><h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>Expenses Table</span></h2><p class="text-muted mb-0"></p></div>
                <div class="create-asset">
                    <button type="button" class="btn btn-success display-flex float-end" data-bs-toggle="modal" data-bs-target="#earningCreate">Add Expenses</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0" id="expensesData" data-searchable-table>
                    <thead>
                    <tr>
                        <th>SL Number</th>
                        <th>Earning Name</th>
                        <th>Description</th>
                        <th>amount</th>
                        <th>Type</th>
                        <th>Earning Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                    </thead>
                    <tbody id="expensesList">

                    </tbody>
                </table>

            </div>
        </section>
    </div>
</main>

<script>
    getExpenses();
    async function getExpenses(){
        let res= await axios.get("/all-expenses");
        let tablebody = $('#expensesData');
        let tableList =  $('#expensesList');

        tablebody.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function (expense, index){
            let row = `
                <tr>
                    <td class="fw-semibold">${index+1}</td>
                    <td class="fw-semibold">${expense['name']}</td>
                    <td class="fw-semibold">${expense['description']}</td>
                    <td class="fw-semibold">${expense['amount']}</td>
                    <td class="fw-semibold">${expense['type']}</td>
                    <td class="fw-semibold">${expense['expense_date']}</td>
                    <td class="fw-semibold"><img src="${expense['img']}" alt="${expense['name']}" width="40" height="35"></td>
                    <td class="fw-semibold">
                        <button data-path="${expense['asset_image']}" data-id="${expense['id']}" class="btn assetEditBtn btn-sm btn-outline-primary rounded-5" type="button" data-bs-toggle="modal" data-bs-target="#assetUpdate">Edit</button>
                        <button data-path="${expense['asset_image']}" data-id="${expense['id']}" class="btn assetDeleteBtn btn-sm btn-outline-danger rounded-5" data-bs-toggle="modal" data-bs-target="#assetDelete">Delete</button>
                    </td>
                 </tr>
            `
            tableList.append(row)
        });

    }    
</script>