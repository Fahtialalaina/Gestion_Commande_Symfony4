var $collectionHolder;

var $addNewItem = $('<a href="#" class="btn btn-info">Add new item</a>');

$(document).ready(function(){
    $collectionHolder = $('#lignecommande_list');

    $collectionHolder.append($addNewItem);

    $collectionHolder.data('index', $collectionHolder.find('.panel'.length))

    $collectionHolder.find('.panel').each(function(){
        addRemoveButton($(this));
    });

    $addNewItem.click(function(e){
        e.preventDefault();
        addNewForm();
    })
    
});

function addNewForm(){
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype;

    newForm = newForm.replace(/__name__/g, index);

    $collectionHolder.data('index', index++);

    var $panel = $('<div class="card bg-secondary text-white mb-2"><div class="card-body"><p class="card-text">Une carte "secondary"</p></div></div>');
    var $panel = $("<div class='panel-body'></div>").append(newForm);
    addRemoveButton($panel);

    $addNewItem.before($panel);
}

function addRemoveButton($panel){
    var $removeButton = $('<a href="#" class="btn btn-danger">Remove</a>');

    var $panelFooter = $('<div class="panel-footer"></div>').append($removeButton);

    $removeButton.click(function(e){
        e.preventDefault();
        $(e.target).parents('.panel').slideUp(1000, function(){
            $(this).remove();
        })
    });

    $panel.append($panelFooter);
}