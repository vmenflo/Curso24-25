import React, { Component } from 'react';
import { Button } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

function Botonera(props){

  
  if(props.playable){
    let lista = [];

    for (let i = 0; i < props.listaBotones.length; i++) {
      for (let j = 0; j < props.listaBotones[i].length; j++) {
        if(i%2===0){
          lista.push(<Button color={props.listaBotones[i][j]} />);
          lista.push(<Button outline />);
        }else{
          lista.push(<Button outline />);
          lista.push(<Button color={props.listaBotones[i][j]} />);
        }
      }
      lista.push(<br/>);
    }
    return(<>{lista}</>);
  }
}

class App extends Component {
  constructor(props){
    super(props);
    this.state = {
      listaBotones: Array(8).fill(Array(8)),
      playable:false,
    };
  }

  jugar(){
    let copPlayable = this.state.playable;
    let copLista = this.state.listaBotones;

    if(copPlayable){
      copPlayable=false;
    }else{
      copPlayable=true;
    }
    

    for (let i = 0; i < 5; i++) {
      copLista[i] = Array(4).fill("secondary");
    }

    for (let j = 5; j < 8; j++) {
      copLista[j] = Array(4).fill("success");
    }

    this.setState({listaBotones:copLista,playable:copPlayable});

  }

  render(){
    return (
      <div className="App">
        <header className="App-header">
          <Button onClick={()=>this.jugar()}>Jugar</Button>
          <br/>
          <Botonera listaBotones={this.state.listaBotones} playable={this.state.playable}/>
        </header>
      </div>
    );
  }
}

export default App;
