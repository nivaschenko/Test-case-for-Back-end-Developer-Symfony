window.onload = function(){
    if ( 'undefined' != typeof data ) { 
    new FancyGrid({
      title: 'Clicks',
      renderTo: 'table',
      width: '100%',
      height: 600,
      data: data,
      selModel: 'row',
      trackOver: true,
      defaults: {
        type: 'string',
        width: 100,
        sortable: true,
        resizable: true,    
        editable: false,
        filter: {
          header: true
        }
      },
      clicksToEdit: 1,
      columns: [{
        index: 'id',
        title: 'id',
        width: 150,
        type: 'string'
      },{
        index: 'ua',
        title: 'user-agent',
        ellipsis: true,
        width: 250,
      },{
        index: 'ip',
        title: 'ip',
        type: 'string',
        width: 200
      },{
        index: 'ref',
        title: 'reference',
        type: 'string',
        width: 250,
      },{
        index: 'param1',
        title: 'param1',
        ellipsis: true,
        width: 200
      },{
        index: 'param2',
        title: 'param2',
        ellipsis: true,
        width: 200
      },{
        index: 'error',
        title: 'error',
        ellipsis: true,
        width: 150
      },{
        index: 'badDomain',
        title: 'bad_domain',
        ellipsis: true,
        width: 150
      }]
    });
} else if ( 'undefined' != typeof badDomain ) {
    
        new FancyGrid({
            title: 'Bad Domains',
            renderTo: 'domains',
            width: '100%',
            height: 600,
            data: badDomain,
            selModel: 'row',
            trackOver: true,
            defaults: {
              type: 'string',
              width: 100,
              sortable: true,
              resizable: true,    
              editable: true,
              filter: {
                header: true
              }
            },
            clicksToEdit: 1,
            columns: [{
              index: 'id',
              title: 'id',
              width: 150,
              type: 'string'
            },{
              index: 'name',
              title: 'Bad Domain',
              ellipsis: true,
              width: 450
            }]
          });
    }
};
