<style>
    .pagination {
        display: inline-block;
    }
    
    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
    }
    
    .pagination a.active {
        background-color: #4CAF50;
        color: white;
        border-radius: 5px;
    }
    
    .pagination a:hover:not(.active) {
        background-color: #ddd;
        border-radius: 5px;
    }
</style>

<div class="pagination">
    <a href="#">«</a>
    <a href="#">1</a>
    <a href="#" class="active">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
    <a href="#">5</a>
    <a href="#">6</a>
    <a href="#">»</a>
</div>