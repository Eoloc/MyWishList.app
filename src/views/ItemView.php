<?php


namespace wishlist\views;


class ItemView extends View
{

    /**
     * @inheritDoc
     */
    public function views(string $view)
    {
        switch ($view){
            case 'showItem':
                $this->showItem();
                break;
            default:
                break;
        }
    }

    private function showItem()
    {
        $arr_item = $this->res[0];
        echo "
        <div>
        <table border=\"2\">
            <thead>
            <tr>
                <th>nom</th>
                <th>description</th>
                <th>image</th>
                <th>url</th>
                <th>tarif</th>
            </tr>
            </thead>
            <tbody> ";
            echo "<tr>";
            echo "<td>$arr_item->nom</td>\n";
            echo "<td>$arr_item->descr</td>\n";
            echo "<td><img src=\"\\img\\" .$arr_item->img."\" height=\"50\"/></td>\n";
            echo "<td>$arr_item->url</td>\n";
            echo "<td>$arr_item->tarif</td>\n";
            echo "</tr>";

        echo "</tbody>
        </table>
    </div>";
    }
}