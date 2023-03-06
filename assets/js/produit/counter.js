$('.counter-plus').click(function (e){
    let qty = $(e.currentTarget).siblings('#qty'  );
    let valueqty = parseInt(qty.val())+1
    if(valueqty > 99){
        valueqty=99
    }
    qty.val(valueqty)
    
});
$('.counter-moin').click(function (e){
    let qty= $(e.currentTarget).siblings('#qty');
    let valueqty = parseInt(qty.val())-1
    if(valueqty < 0){
        valueqty=0
    }
    qty.val(valueqty)
});