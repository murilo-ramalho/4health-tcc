//import { StatusBar } from 'expo-status-bar';
import React from 'react';
import { StyleSheet, Text, View } from 'react-native';
import Title from "./componentes/home/titulo"
import Conta from "./componentes/home/conta/conta"

export default function App() {
  return (
    <View style={styles.container}>
      <Conta style={styles.flex}/>
      
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#88C3E3',
    alignItems: 'center',
    justifyContent: 'flex-start',
  }
});
