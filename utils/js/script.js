import { alterMode } from "./mode/mode.js";
import { sideBarOpen } from "./sidebar/sideBarOpen.js";
import { renderDynamic } from "./rederDynamic/renderDynamic.js";
import { cadastroUser } from "./adm/cadastroUser/cadastroUser.js";
import { editAdm } from "./adm/editAdm/editAdm.js";
import { editProd } from "./produtos/editProd/editProd.js";
import { adicionarImagem } from "./produtos/adicionarImagem/adicionarImagem.js";
import { editCateg } from "./categorias/editCateg/editCateg.js";
import { confirmDeleteUser } from "./adm/confirmDeleteUser/confirmDeleteUser.js";
import { confirmDeleteProduct } from "./produtos/confirmDeleteProduct/confirmDeleteProduct.js";
import { confirmDeleteCateg } from "./categorias/confirmDeleteCateg/confirmDeleteCateg.js";

/* _________________CADASTRO______________ */
cadastroUser();

/* __________________EDIÇÃO_______________ */
editAdm();
await editProd();
editCateg();

/*_____________COMPORTAMENTO______________ */
sideBarOpen();
alterMode();
renderDynamic();
adicionarImagem();

/*________________EXCLUSÃO________________ */

confirmDeleteUser();
confirmDeleteProduct();
confirmDeleteCateg();
