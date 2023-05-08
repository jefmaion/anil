$('table').dataTable({
    pageLength: 10,
    ordering: false,
    lengthMenu: [
        [5,10, 25, 50, -1],
        [5,10, 25, 50, 'Tudo'],
    ],
    columnDefs: [
        { className: "align-middle", targets: "_all" },
    ],
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
    },
    deferRender:true,
    processing:true,
    responsive:true,
    pagingType: $(window).width() < 768 ? 'simple' : 'simple_numbers',

    ajax:'admin',

    columns: [
        {data: 'folder'},
        {data: 'pass'},
        {data: 'size'},
        {data: 'files'},
        {data: 'url'},
        {data: 'action'},
       
    ],
    
});