<template>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h1>Internal Inventory List</h1>
                    <table id="productsList" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Products on Hand</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr v-for="product in products">
                                <td>{{product.itemName}}</td>
                                <td>{{product.productsOnHand}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    module.exports = {
        props: ['propData']
    }
</script>
