<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon"><i class="bi bi-table" aria-hidden="true"></i></span>
                <div>
                    <p class="eyebrow mb-1">Data</p>
                    <h1 class="h3 mb-1">Tables</h1>
                    <p class="text-muted mb-0">Use responsive, searchable tables for operational records.</p>
                </div>
            </div>

        </div>

        <section class="panel">
            <div class="panel-header"><div><h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>Advanced Table</span></h2><p class="text-muted mb-0">Searchable responsive table for orders and customer data.</p></div>
                <div class="create-asset">
                    <button type="button" class="btn btn-success display-flex float-end" data-bs-toggle="modal" data-bs-target="#assetCreate">Add New Asset</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0" id="assetData" data-searchable-table>
                    <thead>
                    <tr>
                        <th>SL Number</th>
                        <th>Asset Name</th>
                        <th>Description</th>
                        <th>Asset Image</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Purchase Date</th>
                        <th>Estimated Life Time</th>
                        <th>Location</th>
                        <th class="text-end">Action</th>
                    </tr>
                    </thead>
                    <tbody id="assetList">

                    </tbody>
                </table>

            </div>
        </section>
    </div>
</main>
<script>
    loadershow();
    getAssetList();
    async function getAssetList() {
        let res = await axios.get("all-asset");

        let tableBody = $('#assetData');
        let tableList = $('#assetList');

        tableBody.DataTable().destroy();
        tableList.empty();

        res.data.forEach( function (asset, index) {
            let row = `
                <tr>
                    <td class="fw-semibold">${index+1}</td>
                    <td class="fw-semibold">${asset['name']}</td>
                    <td class="fw-semibold">${asset['description']}</td>
                    <td class="fw-semibold"><img src="${asset['asset_image']}" alt="${asset['name']}" width="40" height="35"></td>
                    <td class="fw-semibold">${asset['type']}</td>
                    <td class="fw-semibold">${asset['price']}</td>
                    <td class="fw-semibold">${asset['purchase_date']}</td>
                    <td class="fw-semibold">${asset['estimated_lifetime']} years</td>
                    <td class="fw-semibold">${asset['location']}</td>
                    <td class="fw-semibold">
                        <button data-path="${asset['asset_image']}" data-id="${asset['id']}" class="btn editBtn btn-sm btn-outline-primary rounded-5" type="button" data-bs-toggle="modal" data-bs-target="#updateBrand">Edit</button>
                        <button data-path="${asset['asset_image']}" data-id="${asset['id']}" class="btn deleteBtn btn-sm btn-outline-danger rounded-5" data-bs-toggle="modal" data-bs-target="#deleteBrand">Delete</button>
                    </td>
                 </tr>

            `
            tableList.append(row)
        });

        $(document).ready( function () {
            $('#assetData').DataTable({
                order: [[0, 'desc']],
                lengthMenu: [10, 20, 30, { label: 'All', value: -1 }]
            });
        } );

    }
</script>
