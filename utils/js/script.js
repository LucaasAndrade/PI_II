import { adicionarImagem } from "./adicionarImagem/adicionarImagem.js";
import { editAdm } from "./editAdm/editAdm.js";
import { alterMode } from "./mode/mode.js";
import { sideBarOpen } from "./sidebar/sideBarOpen.js";
import { renderDynamic } from "./rederDynamic/renderDynamic.js";
import { editProd } from "./editProd/editProd.js";
import { confirmDeleteUser } from "./confirmDeleteUser/confirmDeleteUser.js";
import { confirmDeleteProduct } from "./confirmDeleteProduct/confirmDeleteProduct.js";
import { cadastroUser } from "./cadastroUser/cadastroUser.js";

sideBarOpen();
alterMode();
renderDynamic();
adicionarImagem();
editAdm();
await editProd();
confirmDeleteUser();
confirmDeleteProduct();
cadastroUser();