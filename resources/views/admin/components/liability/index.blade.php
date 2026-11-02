<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">           
        </div>
        <section class="panel">
            <div class="panel-header"><div><h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>List of Liabilities</span></h2><p class="text-muted mb-0">Searchable responsive table for liability data.</p></div>
                <div class="create-liability">
                    <button type="button" class="btn btn-success display-flex float-end" data-bs-toggle="modal" data-bs-target="#liabilityCreate">Add New Liability</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0" id="liabilityTable" data-searchable-table>
                    <thead>
                    <tr>
                        <th>SL <br>Number</th>
                        <th>Name of <br>Liability</th>
                        <th>Lender <br>Name</th>
                        <th>Loan <br>Amount</th>
                        <th>Rate of <br>Interest</th>
                        <th>Start <br>Date</th>
                        <th>End <br>Date</th>
                        <th>Paid <br>Amount</th>
                        <th>Total <br>Amount</th>
                        <th>Outstanding</th>
                        <th>Notes</th>
                        <th class="text-end">Action</th>
                    </tr>
                    </thead>
                    <tbody id="liabilityList">

                    </tbody>
                </table>

            </div>
        </section>
    </div>
</main>
<script>
    getLiability();
    async function getLiability(){
        let res = await axios.get("/get-liability");

        let tableBody = $('#liabilityTable');
        let tableList = $('#liabilityList');

        tableBody.DataTable().destroy();
        tableList.empty();
        res.data.forEach( function (item, index){
            let row = `
            <tr>
                    <td class="fw-semibold">${index+1}</td>
                    <td class="fw-semibold">${item['loan_name']}</td>
                    <td class="fw-semibold">${item['lender_name']}</td>
                    <td class="fw-semibold">${item['loan_amount']}</td>
                    <td class="fw-semibold">${item['interest_rate']}</td>
                    <td class="fw-semibold">${item['start_date']}</td>
                    <td class="fw-semibold">${item['end_date']}</td>
                    <td class="fw-semibold">${item['paid']}</td>
                    <td class="fw-semibold">${item['total_amount']}</td>
                    <td class="fw-semibold">${item['outstanding_amount']}</td>
                    <td class="fw-semibold">${item['notes']}</td>
                    <td class="fw-semibold">
                        <button data-id="${item['id']}" class="btn acPayEditBtn btn-sm btn-outline-primary rounded-5" type="button" data-bs-toggle="modal" data-bs-target="#acPayUpdate">Edit</button>
                        <button data-id="${item['id']}" class="btn acPayDeleteBtn btn-sm btn-outline-danger rounded-5" data-bs-toggle="modal" data-bs-target="#acPayDelete">Delete</button>
                    </td>
                </tr>
            `;
            tableList.append(row);
        })
        
        $(document).ready( function () {
            $('#liabilityTable').DataTable({
                order: [[0, 'desc']],
                lengthMenu: [10, 20, 30, { label: 'All', value: -1 }]
            });
        } );


    }
</script>