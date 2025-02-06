import React, { Component } from 'react';
import { Button } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
const MapaBotones = (props) => {
  let lista = []
  for (let i = 0; i < props.listaBotones.length; i++) {
    let lista2=[]
    for (let j = 0; j < props.listaBotones.length; j++) {
      if(i===0){
        lista2.push(<><Button key={i+j} onClick={()=>props.clica(i,j)} color={props.listaBotones[i][j].color} outline={props.listaBotones[i][j].outline}/></>)
      }else{
        lista2.push(<><Button key={i+j} color={props.listaBotones[i][j].color} outline={props.listaBotones[i][j].outline}/></>)
      }
    }
    lista.push(<>{lista2}<br/></>)
  }
  return(lista);
}
class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      listaBotones: Array(9).fill(null),
      // no se puede modificar el state
    }
  }
  clica(x, y) {
    // x se supone que la columna, y la fila
    let copia = this.state
    let tope = 8;
    let libre=false;

    while(!libre && tope!==0){
      if(copia.listaBotones[tope][y].color==="secondary"){
        copia.listaBotones[tope][y].color="primary";
        copia.listaBotones[tope][y].outline=false;
        libre=true;
      }
      tope--;
    }
    this.setState({copia})
  }
  componentWillMount() {
    // aquí es donde creo las nueve columnas con los datos iniciales.
    let copia = this.state.listaBotones;
    for (let i = 0; i < copia.length; i++) {
      let lista2 = [];
      for (let j = 0; j < copia.length; j++) {
        lista2.push({outline:true,color:"secondary"});
      }
      copia[i]=lista2;
    }
    this.setState({listaBotones:copia});
  }
  render() {
    return (
      <div className="App">
        <h1> BUCHACA </h1>
        <MapaBotones listaBotones={this.state.listaBotones} clica={(x,y)=>this.clica(x,y)}/>
      </div>
    );
  }
}
export default App;