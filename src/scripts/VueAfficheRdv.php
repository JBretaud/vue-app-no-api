<script>
    var AfficheRdv = new Vue({

// A DOM element to mount our view model.

el: '.dispRdv',

// Define properties and give them initial values.

data: {
    listeRdv:'',
    requete:'',
},

// Functions we will be using.

methods: {
    hydrateListeRdv:function(){
        var test=new Array()
            this.requete.forEach(function(creneau){
                creneau.replace(' ','T');
                test.push(new Date(creneau));
            });
            this.listeRdv=test;
    }
},
beforeMount(){
        this.requete=<?php 
                        if(isset($listeCreneaux)){
                            echo json_encode($listeCreneaux);
                        }else{
                            echo "''";
                        }?>,
        this.hydrateListeRdv();
    },
});
</script>