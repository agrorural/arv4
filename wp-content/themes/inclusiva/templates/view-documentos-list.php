<?php
	// ACF Archive Page
	//Consume datos desde ajax en /scripts/is.js

?>

    <div id="insta-search">
        <form class="form-inline" action="" method="GET">
            <div class="form-group">
                <?php $currentYear = date('Y'); ?>
				
                <label for="txtKeyword">Palabra</label>
                <input type="text" id="txtKeyword" class="form-control" name="txtKeyword">

                <label for="optMonth">Mes</label>
                <select id="optMonth" class="form-control" name="optMonth">
                    <option value="">Todos</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>

                <label for="optYear">Año</label>
                <select id="optYear" class="form-control" name="optYear">
                    <option value="<?php echo $currentYear; ?>"><?php echo $currentYear; ?></option>
                    <?php
                        for ($i = $currentYear -1; $i >= 2009; $i--) {
                            echo ' <option value="' . $i .'">' . $i . '</option>';
                        }
                    ?>
                </select>

                <label for="optPerPage">Listar</label>
                <select id="optPerPage" class="form-control" name="optPerPage">
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            <button id="btnDocumento" type="submit" class="btn btn-default" data-loading-text="Buscando..." >Buscar</button>
        </form>
        <div class="wp-pagenavi"></div>
        <div class="search-result"></div>
        <div class="wp-pagenavi"></div>
    </div>
