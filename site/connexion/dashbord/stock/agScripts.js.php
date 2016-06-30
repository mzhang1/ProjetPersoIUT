$(document).ready(function(){
    $selectContainer = $(document).find('.selectContainer');
    var $entreeStock = $(document).find('.conteneurTableEntree');
    var $sortieStock = $(document).find('.conteneurTableSortie');

    getFileData(user_id);
    $selectContainer.append('<button type="button" class="btn btn-primary creationFicheStock">Créer une fiche de stock</button>');
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

$(document).find('.createNewEntry').off().on("click", function(){
    if(produits.length > 0){
        var $entreeStockTable = $(document).find('.conteneurTableEntree').find('.tableEntree');
        $entreeStockTable.html("");
        var $entreeStockForm = $('<form class="entryStockForm"></form>');

        var $entreeStockFormTitle = $('<h3 class="text-center entryStockFormTitle">Création d&rsquo;une entrée</h3>');
        $entreeStockForm.append($entreeStockFormTitle);

        var $qtyDiv = $('<div class="form-group row"></div>');
        var $qtyLabel = $('<label for="entryQty" class="col-md-offset-1 col-md-3 form-control-label">Quantité entrée</label>');
        var $qtyFieldDiv = $('<div class="col-md-7"></div>');
        var $qtyFieldInput = $('<input id="entryQty" type="text" class="form-control entryQtyField" placeholder="Quantité entrée">');
        $qtyFieldDiv.append($qtyFieldInput);
        $qtyDiv.append($qtyLabel);
        $qtyDiv.append($qtyFieldDiv);
        $entreeStockForm.append($qtyDiv);

        var $productDiv = $('<div class="form-group row"></div>');
        var $selectProductLabel = $('<label for="productSelect" class="col-md-offset-1 col-md-3 form-control-label">Produit</label>');
        var $selectProductDiv = $('<div class="col-md-7"></div>');
        var $selectProduct = $('<select id="productSelect" class="form-control productSelect">');

        for(var i=0; i<produits.length; i++){
            var $productSelectOption = $('<option value="'+produits[i].productId+'">'+produits[i].productId+' -- '+produits[i].nomProduit+'</option>');
            $selectProduct.append($productSelectOption);
        }

        $selectProductDiv.append($selectProduct);
        $productDiv.append($selectProductLabel);
        $productDiv.append($selectProductDiv);
        $entreeStockForm.append($productDiv);

        $validateEntryButtonDiv = $('<div class="col-md-offset-4 col-md-4"></div>');
        $validateEntryButton = $('<button type="button" class="btn btn-primary btn-sm confirmEntreeCreation">Sauvegarder l&rsquo;entrée</button>');
        $validateEntryButtonDiv.append($validateEntryButton);
        $entreeStockForm.append($validateEntryButtonDiv);

        $validateEntryButton.off().on("click",function(){
            var quantite = $(document).find(".entryQtyField").val();
            var selectedProduct = $(document).find(".productSelect").val();

            $.ajax({
                url: "requests.php",
                dataType: "json",
                data:{
                    user_id: user_id,
                    qty: quantite,
                    productId: selectedProduct,
                    record_id: selected,
                    req: "addNewEntry"
                },
                success:function(data){
                    entrees = data.entrees;
                    var $entreeStockTable = $(document).find('.conteneurTableEntree').find('.tableEntree');
                    $entreeStockTable.html("");
                    loadEntriesData();
                }
            });
        });

        $entreeStockTable.append($entreeStockForm);
    }
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
                    entrees = data.records[i].entrees;
                    sorties = data.records[i].sorties;
                    $(document).find(".stockFileName").html(data.records[i].nom);
                }
            }
            buildFileSelect($selectContainer,data,selected);
            $(document).find(".numberProducts").html(produits.length);

            if(produits.length <= 0){
                $(document).find('.noProductAvailable').css("display","block");
                $entreeStock.css("display","none");
                $sortieStock.css("display","none");
            }

            if(entrees.length > 0){
                loadEntriesData();
            }
            if(sorties.length > 0){
                loadOutputData();
            }
        },
        async: false
    });
};

function buildFileSelect($container,data,selected){
    var files = data.records;
    var numberFiles = files.length;
    if(numberFiles != 0){
        $select = $('<select class="fileSelect"></select>');
        for(var i=0;i < numberFiles; i++){
            if(files[i].id == selected){
                $option = $('<option value="'+files[i].id+'" selected>'+files[i].id+" -- "+files[i].nom+'</option>');
            }
            else{
                $option = $('<option value="'+files[i].id+'">'+files[i].id+" -- "+files[i].nom+'</option>');
            }
            $select.append($option);
        }
        $container.append($select);
        $container.find('.numberFiles').html(numberFiles);
    }
};

function updateProductInformations($container,data,index){

};

/* Chargement des tables */
function loadEntriesData(){
    var $tableEntriesContainer = $(document).find('.tableEntree');
    $tableEntriesContainer.html("");

    var $entryTable = $('<table class="table table-bordered inputTableData"></table>');
    var $tableHeaders = $('<thead></thead>');
    $tableHeaderRow = $('<tr></tr>');
    $tableHeaderRow.append('<th>Nom du produit</th>');
    $tableHeaderRow.append('<th>Date d&rsquo;entrée</th>');
    $tableHeaderRow.append('<th>Quantité</th>');
    $tableHeaderRow.append('<th>Prix total</th>');
    $tableHeaders.append($tableHeaderRow);
    $entryTable.append($tableHeaders);

    var $tableBody = $('<tbody></tbody>');
    for(var i=0;i<entrees.length;i++){
        var $tableRow = $('<tr class="entryTableRow"></tr>');

        var produit = {};
        for(var j=0; j<produits.length; j++){
            if(produits[j].productId == entrees[i].id_produit){
                produit = produits[j];
                break;
            }
        }

        $tableRow.append("<td>"+produit.nomProduit+"</td>");
        $tableRow.append("<td>"+entrees[i].dateEntree+"</td>");
        $tableRow.append("<td>"+entrees[i].qteEntree+"</td>");
        $tableRow.append("<td>"+(produit.pu*entrees[i].qteEntree)+"</td>");
        $tableBody.append($tableRow);
    }
    $entryTable.append($tableBody);

    $tableEntriesContainer.append($entryTable);
};

function onLoadOutputData(){

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

    $(document).find(".returnToMainPage").off().on('click',function(){
        $(document).find('.productContainer').css('display','none');
        $(document).find('.stockContainer').css('display','block');
    });

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
            var productId = event.data.product.productId;

            $table.find(".productTableRow").removeClass("activeRow");
            $table.find(".productTableRow").eq(event.data.rowIndex).addClass("activeRow");

            var $saveButton = $(document).find('.confirmModifications');
            var $deleteButton = $(document).find('.deleteProduct');
            $saveButton.attr("disabled",false);
            $deleteButton.attr("disabled",false);

            var $headerForm = $(document).find('.productForm');
            $headerForm.find('.productNameField').attr("disabled",false);
            $headerForm.find('.categoryProductField').attr("disabled",false);
            $headerForm.find('.puField').attr("disabled",false);
            $headerForm.find('.fournisseurField').attr("disabled",false);

            $headerForm.find('.productNameField').val(product.nomProduit);
            $headerForm.find('.categoryProductField').val(product.libelle_type);
            $headerForm.find('.qteField').val(product.qte);
            $headerForm.find('.puField').val(product.pu);
            $headerForm.find('.ptField').val(product.pt);
            $headerForm.find('.fournisseurField').val(product.libelle_fournisseur);

            $saveButton.off().on("click",{id: productId},function(event){
                var productName = $headerForm.find('.productNameField').val();
                var productCategory = $headerForm.find('.categoryProductField').val();
                var productPU = $headerForm.find('.puField').val();
                var productSupplier = $headerForm.find('.fournisseurField').val();

                $.ajax({
                    url: "requests.php",
                    dataType: "json",
                    data:{
                        user_id: user_id,
                        record_id: selected,
                        product_id: event.data.id,
                        newProductName: productName,
                        newProductCategory: productCategory,
                        newProductPrice: productPU,
                        newProductSupplier: productSupplier,
                        req: "updateProduct"
                    },
                    success:function(data){
                        produits = data.produits;
                        $deleteButton.attr("disabled",true);
                        $saveButton.attr("disabled",true);

                        $headerForm.find('.productNameField').attr("disabled",true);
                        $headerForm.find('.categoryProductField').attr("disabled",true);
                        $headerForm.find('.puField').attr("disabled",true);
                        $headerForm.find('.fournisseurField').attr("disabled",true);

                        $headerForm.find('.productNameField').val("");
                        $headerForm.find('.categoryProductField').val("");
                        $headerForm.find('.qteField').val("");
                        $headerForm.find('.puField').val("");
                        $headerForm.find('.ptField').val("");
                        $headerForm.find('.fournisseurField').val("");

                        loadProductWindow();
                    }
                });
            });

            $deleteButton.off().on("click",{id: productId},function(event){
                $.ajax({
                    url: "requests.php",
                    dataType: "json",
                    data:{
                        user_id: user_id,
                        record_id: selected,
                        product_id: event.data.id,
                        req: "deleteProduct"
                    },
                    success:function(data){
                        produits = data.produits;
                        $deleteButton.attr("disabled",true);
                        $saveButton.attr("disabled",true);

                        $headerForm.find('.productNameField').attr("disabled",true);
                        $headerForm.find('.categoryProductField').attr("disabled",true);
                        $headerForm.find('.puField').attr("disabled",true);
                        $headerForm.find('.fournisseurField').attr("disabled",true);

                        $headerForm.find('.productNameField').val("");
                        $headerForm.find('.categoryProductField').val("");
                        $headerForm.find('.qteField').val("");
                        $headerForm.find('.puField').val("");
                        $headerForm.find('.ptField').val("");
                        $headerForm.find('.fournisseurField').val("");

                        loadProductWindow();
                    }
                });
            });
        });
    }
    $table.append($tableBody);
    $tableProduct.append($table);
};
