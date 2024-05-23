import { alterMode } from "./mode/mode.js";
import { sideBarOpen } from "./sidebar/sideBarOpen.js";
import { renderDynamic } from "./renderDynamic/renderDynamic.js";
import { cadastroUser } from "./adm/cadastroUser/cadastroUser.js";
import { editAdm } from "./adm/editAdm/editAdm.js";
import { editProd } from "./produtos/editProd/editProd.js";
import { adicionarImagem } from "./produtos/adicionarImagem/adicionarImagem.js";
import { editCateg } from "./categorias/editCateg/editCateg.js";
import { confirmDeleteUser } from "./adm/confirmDeleteUser/confirmDeleteUser.js";
import { confirmDeleteProduct } from "./produtos/confirmDeleteProduct/confirmDeleteProduct.js";
import { confirmDeleteCateg } from "./categorias/confirmDeleteCateg/confirmDeleteCateg.js";
import { cadastroProduto } from "./produtos/cadastroProduto/cadastroProduto.js";
import { cadastroCateg } from "./categorias/cadastroCateg/cadastroCateg.js";
import { searchAdm } from "./adm/searchAdm/searchAdm.js";
import { searchCateg } from "./categorias/searchCateg/searchCateg.js";
import { searchProd } from "./produtos/searchProd/searchProd.js";

renderDynamic();

/* _________________CADASTRO______________ */

cadastroUser();
cadastroProduto();
cadastroCateg();

/* __________________EDIÇÃO_______________ */

editAdm();
editProd();
editCateg();

/*_____________COMPORTAMENTO______________ */

sideBarOpen();
alterMode();
adicionarImagem();

/*________________EXCLUSÃO________________ */

confirmDeleteUser();
confirmDeleteProduct();
confirmDeleteCateg();

/*________________PESQUISA_______________ */

searchAdm();
searchCateg();
searchProd();
