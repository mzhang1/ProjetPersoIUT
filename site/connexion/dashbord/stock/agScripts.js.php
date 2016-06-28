$(document).ready(function(){
    $selectContainer = $(document).find('.selectContainer');
    $entreeStock = $(document).find('.conteneurTableEntree').find('.tableEntree');
    $sortieStock = $(document).find('.conteneurTableSortie');

    $.ajax({
        url: "requests.php",
        dataType: "json",
        data:{
            user_id: user_id,
            req: "getUserRecords"
        },
        success:function(data){
            buildFileSelect($selectContainer,data);
            //onLoadEntriesData(data.entree);
            //onLoadOutData(data.sortie);
        },
        error:function(){
            alert("Error");
        }
    });
});

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
}

function updateProductInformations($container,data,index){

}

/* Chargement des tables */
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
    new agGrid.Grid(container,params);
};

function buildOutGrid($container){

}
