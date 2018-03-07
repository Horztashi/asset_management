var options = {
  valueNames: [ 'name' , 'status', 'employee'], page: 25, pagination: true
};

var dataList = new List('datalist', options);

$('.asset-collection').collection({ allow_duplicate: false,
                                            allow_up: false,
                                            allow_down: false,
                                            up: '<a href="#" class="btn btn-primary with-margin"><i class="fas fa-chevron-up"></i></a>',
                                            down: '<a href="#" class="btn btn-primary with-margin"><i class="fas fa-chevron-down"></i></a>',
                                            add: '<a href="#" class="btn btn-primary with-margin"><i class="fas fa-plus"></i></a>',
                                            remove: '<a href="#" class="btn btn-danger with-margin"><i class="fas fa-trash-alt"></i></a>',
                                            duplicate: '<a href="#" class="btn btn-primary with-margin"><i class="fas fa-copy"></i></a>'
     });