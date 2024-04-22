import { adicionarImagem } from "./adicionarImagem/adicionarImagem.js";
import { editAdm } from "./editAdm/editAdm.js";
import { alterMode } from "./mode/mode.js";
import { sideBarOpen } from "./sidebar/sideBarOpen.js";
import  {renderDynamic } from "./rederDynamic/renderDynamic.js"

sideBarOpen();
alterMode();
renderDynamic();
adicionarImagem();
editAdm();
