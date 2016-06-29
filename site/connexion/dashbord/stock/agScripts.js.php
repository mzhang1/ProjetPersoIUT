$(document).ready(function(){
    $selectContainer = $(document).find('.selectContainer');
    $entreeStock = $(document).find('.conteneurTableEntree').find('.tableEntree');
    $sortieStock = $(document).find('.conteneurTableSortie');
    getFileData(user_id);
});

$(document).find(".affichageListeProduit").click(function(){
    $(document).find('.stockContainer').css('display','none');
    $(document).find('.productContainer').css('display','block');

    if(produits){
        loadProductWindow();
    }

    $(document).find(".createNewProduct").click(function(){
        $.ajax({
            url: "requests.php",
            dataType: "json",
            data:{
                user_id: user_id,
                file_id: selected,
                req: "addProduct"
            },
            success:function(data){
                produits = data.produits;
                loadProductWindow();
            }
        });
    });
});

function getFileData(user_id){
    $.ajax({
        url: "requests.php",
        dataType: "json",
        data:{
            user_id: user_id,
            req: "getUserRecords"
        },
        success:function(data){
            selected = parseInt(data.selectedIndex,10);
            produits = [];
            for(var i=0;i<data.records.length;i++){
                if(data.records[i].id == selected){
                    produits = data.records[i].produits;
                }
            }
            buildFileSelect($selectContainer,data);
            $(document).find(".numberProducts").html(produits.length);
            //onLoadEntriesData(data.entree);
            //onLoadOutData(data.sortie);
        }
    });
};

function buildFileSelect($container,data){
    var files = data.records;
    var numberFiles = files.length;
    if(numberFiles != 0){
        $select = $('<select class="fileSelect"></select>');
        for(var i=0;i < numberFiles; i++){
            $option = $('<option value="'+files[i].id+'">'+files[i].id+" -- "+files[i].nom+'</option>');
            $select.append($option);
        }
        $container.append($select);
        $container.find('.numberFiles').html(numberFiles);
    }
};

function updateProductInformations($container,data,index){

};

/* Chargement des tables */
/*
function onLoadEntriesData(data){
    var columnData = [
        {headerName: "Produit", field: "produit", editable: true, width: 200},
        {headerName: "Prix Unitaire", field: "pu", editable: true, width: 60},
        {headerName: "Total", field: "total", editable: true, width: 60},
        {headerName: "Date", field: "date", editable: true, width: 70},
        {headerName: "Fournisseur", field: "supplier", editable: true, width: 150}
    ];

    var rowData = [
        {produit: "150", pu:"180",total:"180"},
        {produit: "180", pu:"210",total:"210"}
    ];

    var params = {
        columnDefs : columnData,
        rowData : rowData,
        enableColResize: false
    };

    var container = document.querySelector('.tableEntree');
    var entryGrid = new agGrid.Grid(container,params);

    var secondContainer = document.querySelector('.tableSortie');
    var outGrid = new agGrid.Grid(secondContainer,params);
};
*/

function onLoadOutData($container){

};

/* Chargement des produits */
function loadProductWindow(){
    var $tableProduct = $(document).find(".tableProduct");
    $tableProduct.html("");
    var $table = $('<table class="table table-bordered tableData"></table>');
    var $tableHeaders = $('<thead></thead>');
    $tableHeaderRow = $('<tr></tr>');
    $tableHeaderRow.append('<th>Nom du produit</th>');
    $tableHeaderRow.append('<th>Catégorie</th>');
    $tableHeaderRow.append('<th>Quantité</th>');
    $tableHeaderRow.append('<th>Prix unitaire</th>');
    $tableHeaderRow.append('<th>Prix total</th>');
    $tableHeaderRow.append('<th>Fournisseur</th>');
    $tableHeaders.append($tableHeaderRow);
    $table.append($tableHeaders);

    var $tableBody = $('<tbody></tbody>');
    for(var i=0;i<produits.length;i++){
        var $tableRow = $('<tr class="productTableRow"></tr>');
        $tableRow.append("<td>"+produits[i].nomProduit+"</td>");
        $tableRow.append("<td>"+produits[i].libelle_type+"</td>");
        $tableRow.append("<td>"+produits[i].qte+"</td>");
        $tableRow.append("<td>"+produits[i].pu+"</td>");
        $tableRow.append("<td>"+produits[i].pt+"</td>");
        $tableRow.append("<td>"+produits[i].libelle_fournisseur+"</td>");
        $tableBody.append($tableRow);

        $tableRow.click({rowIndex: i,product: produits[i]},function(event){
            var product = event.data.product;
            $table.find(".productTableRow").removeClass("activeRow");
            $table.find(".productTableRow").eq(event.data.rowIndex).addClass("activeRow");

            var $deleteButton = $(document).find('.deleteProduct');
            $deleteButton.attr("disabled",false);
            $deleteButton.click({id: produits[i].productId},function(event){
                alert(event.data.id);
            });

            var $headerForm = $(document).find('.productForm');
            $headerForm.find('.productNameField').attr("disabled",false);
            $headerForm.find('.categoryProductField').attr("disabled",false);
            $headerForm.find('.puField').attr("disabled",false);
            $headerForm.find('.fournisseurField').attr("disabled",false);

            $headerForm.find('.productNameField').val(product.nomproduit);
            $headerForm.find('.categoryProductField').val(product.libelle_type);
            $headerForm.find('.qteField').val(product.qte);
            $headerForm.find('.puField').val(product.pu);
            $headerForm.find('.ptField').val(product.pt);
            $headerForm.find('.fournisseurField').val(product.libelle_fournisseur);
        });


    }
    $table.append($tableBody);
    $tableProduct.append($table);
};
